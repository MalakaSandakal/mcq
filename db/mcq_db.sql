-- create database mcq_db;

CREATE EXTENSION IF NOT EXISTS "uuid-ossp";

-- users table
CREATE TABLE users (
    id       UUID DEFAULT uuid_generate_v4() NOT NULL,
    username TEXT                            NOT NULL,
    password TEXT                            NOT NULL
);
ALTER TABLE users
    ADD CONSTRAINT users_pk PRIMARY KEY (id);
CREATE UNIQUE INDEX users_id_uindex ON users (id);
CREATE UNIQUE INDEX users_username_uindex ON users (username);

-- questions table
CREATE TABLE questions (
    id           UUID        DEFAULT uuid_generate_v4() NOT NULL,
    question     TEXT                                   NOT NULL,
    date_created TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP,
    date_updated TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE questions
    ADD CONSTRAINT questions_pk PRIMARY KEY (id);
CREATE UNIQUE INDEX questions_id_uindex ON questions (id);
CREATE UNIQUE INDEX questions_question_uindex ON questions (question);

-- answers table
CREATE TABLE answers (
    id          UUID    DEFAULT uuid_generate_v4() NOT NULL,
    answer      TEXT                               NOT NULL,
    is_correct  BOOLEAN DEFAULT FALSE              NOT NULL,
    question_id UUID                               NOT NULL
);

ALTER TABLE answers
    ADD CONSTRAINT answers_pk PRIMARY KEY (id);
CREATE UNIQUE INDEX answers_id_uindex ON answers (id);
CREATE UNIQUE INDEX answers_question_answer_uindex ON answers (question_id, answer);


ALTER TABLE answers
    ADD CONSTRAINT answers_question_id_fk FOREIGN KEY (question_id) REFERENCES questions (id) ON DELETE CASCADE;

-- categories table
CREATE TABLE categories (
    id   UUID DEFAULT uuid_generate_v4() NOT NULL,
    name TEXT                            NOT NULL
);

ALTER TABLE categories
    ADD CONSTRAINT categories_pk PRIMARY KEY (id);
CREATE UNIQUE INDEX categories_id_uindex ON categories (id);
CREATE UNIQUE INDEX categories_name_uindex ON categories (name);

-- question categories table
CREATE TABLE question_categories (
    id          UUID DEFAULT uuid_generate_v4() NOT NULL,
    question_id UUID                            NOT NULL,
    category_id UUID                            NOT NULL
);

ALTER TABLE question_categories
    ADD CONSTRAINT question_categories_pk PRIMARY KEY (id);

ALTER TABLE question_categories
    ADD CONSTRAINT question_categories_question_id_fk FOREIGN KEY (question_id) REFERENCES questions (id) ON DELETE CASCADE;

ALTER TABLE question_categories
    ADD CONSTRAINT question_categories_category_id_fk FOREIGN KEY (category_id) REFERENCES categories (id);
CREATE UNIQUE INDEX question_categories_question_category_uindex ON question_categories (question_id, category_id);


CREATE OR REPLACE FUNCTION add_question(_body JSON) RETURNS JSON AS
$$
DECLARE
    _question_id UUID;
    _answer      JSON;
BEGIN
    INSERT INTO questions (question, sort_order) VALUES ((_body ->> 'question')::TEXT,(_body ->> 'sort_order')::INT) RETURNING id INTO _question_id;
    INSERT INTO question_categories(question_id, category_id) VALUES (_question_id, (_body ->> 'category')::uuid);

    FOR _answer IN SELECT * FROM JSON_ARRAY_ELEMENTS((_body ->> 'answers')::JSON)
        LOOP
            INSERT INTO answers (answer, question_id, is_correct) VALUES ((_answer ->> 'answer')::TEXT, _question_id,(_answer ->> 'is_correct')::BOOLEAN );
        END LOOP;
    return get_question(_question_id);
END
$$ LANGUAGE plpgsql;



CREATE OR REPLACE FUNCTION get_question(_id UUID) RETURNS JSON AS
$$
DECLARE
    _output JSON;
BEGIN
    SELECT ROW_TO_JSON(q)
    INTO _output
    FROM (
             SELECT id,
                    question,sort_order,
                    (SELECT category_id FROM question_categories WHERE question_id = questions.id)AS category,
                    (SELECT ARRAY_TO_JSON(ARRAY_AGG(ROW_TO_JSON(rec)))
                     FROM (
                              SELECT answer,is_correct
                              FROM answers
                              WHERE question_id = questions.id
                          ) rec) AS answers
             FROM questions
             WHERE id = _id
         ) q;
    RETURN _output;
END
$$ LANGUAGE plpgsql;


CREATE OR REPLACE FUNCTION update_question(_question_id uuid,_body JSON) RETURNS JSON AS
$$
DECLARE
    _answer      JSON;
BEGIN
-- update
    -- DELETE FROM questions WHERE  question_id = _question_id;

    -- INSERT INTO questions(question, sort_order) VALUES ((_body->>'question')::TEXT, (_body->>'sort_order')::INT) RETURNING id INTO _question_id;

    UPDATE questions SET question = (_body ->> 'question')::TEXT, sort_order=(_body ->> 'sort_order')::INT WHERE id = _question_id::uuid;

    DELETE FROM question_categories WHERE question_id = _question_id; 

    INSERT INTO question_categories(question_id, category_id) VALUES (_question_id, (_body ->> 'category')::uuid);

    DELETE FROM answers WHERE question_id = _question_id;

    FOR _answer IN SELECT * FROM JSON_ARRAY_ELEMENTS((_body ->> 'answers')::JSON)
        LOOP
            INSERT INTO answers (answer, question_id, is_correct) VALUES ((_answer ->> 'answer')::TEXT, _question_id,(_answer ->> 'is_correct')::BOOLEAN );
        END LOOP;
    return get_question(_question_id);
END
$$ LANGUAGE plpgsql;