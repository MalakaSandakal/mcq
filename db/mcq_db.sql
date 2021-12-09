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
    sort_order   INT         DEFAULT 0                  NOT NULL,
    date_created TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP  NOT NULL,
    date_updated TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP  NOT NULL
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
    question_id UUID NOT NULL,
    category_id UUID NOT NULL
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
    INSERT INTO questions (question, sort_order)
    VALUES ((_body ->> 'question')::TEXT, (_body ->> 'sort_order')::INT)
    RETURNING id INTO _question_id;
    INSERT INTO question_categories(question_id, category_id) VALUES (_question_id, (_body ->> 'category')::UUID);
    FOR _answer IN SELECT * FROM JSON_ARRAY_ELEMENTS((_body ->> 'answers')::JSON)
        LOOP
            INSERT INTO answers (answer, question_id, is_correct)
            VALUES ((_answer ->> 'answer')::TEXT, _question_id, (_answer ->> 'is_correct')::BOOLEAN);
        END LOOP;
    RETURN get_question(_question_id);
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
                    question,
                    sort_order,
                    (SELECT category_id FROM question_categories WHERE question_id = questions.id) AS category,
                    (SELECT COALESCE(ARRAY_TO_JSON(ARRAY_AGG(ROW_TO_JSON(rec))), '[]'::JSON)
                     FROM (
                              SELECT answer, is_correct
                              FROM answers
                              WHERE question_id = questions.id
                          ) rec) AS answers
             FROM questions
             WHERE id = _id
         ) q;
    RETURN _output;
END
$$ LANGUAGE plpgsql;
CREATE OR REPLACE FUNCTION update_question(_question_id UUID, _body JSON) RETURNS JSON AS
$$
DECLARE
    _answer JSON;
BEGIN
    UPDATE questions
    SET question  = (_body ->> 'question')::TEXT,
        sort_order=(_body ->> 'sort_order')::INT
    WHERE id = _question_id::UUID;
    DELETE FROM question_categories WHERE question_id = _question_id;
    INSERT INTO question_categories(question_id, category_id) VALUES (_question_id, (_body ->> 'category')::UUID);
    DELETE FROM answers WHERE question_id = _question_id;
    FOR _answer IN SELECT * FROM JSON_ARRAY_ELEMENTS((_body ->> 'answers')::JSON)
        LOOP
            INSERT INTO answers (answer, question_id, is_correct)
            VALUES ((_answer ->> 'answer')::TEXT, _question_id, (_answer ->> 'is_correct')::BOOLEAN);
        END LOOP;
    RETURN get_question(_question_id);
END
$$ LANGUAGE plpgsql;


CREATE OR REPLACE FUNCTION get_questions_by_category(_category_id UUID) RETURNS JSON AS
$$
DECLARE
    _questions JSON;
BEGIN
    SELECT COALESCE(ARRAY_TO_JSON(ARRAY_AGG(ROW_TO_JSON(rec))), '[]'::JSON)
    INTO _questions
    FROM (
             SELECT question,
                    (SELECT COALESCE(ARRAY_TO_JSON(ARRAY_AGG(ROW_TO_JSON(c))), '[]'::JSON)
                     FROM (
                              SELECT name
                              FROM categories
                              WHERE id IN (SELECT category_id FROM question_categories WHERE question_id = questions.id)
                              ORDER BY name ASC
                          ) c) AS categories,
                    (SELECT COALESCE(ARRAY_TO_JSON(ARRAY_AGG(ROW_TO_JSON(a))), '[]'::JSON)
                     FROM (
                              SELECT answer, is_correct
                              FROM answers
                              WHERE question_id = questions.id
                          ) a) AS answers
             FROM questions
             WHERE id IN (SELECT question_id FROM question_categories WHERE category_id = _category_id)
             ORDER BY sort_order
         ) rec;
    RETURN _questions;
END;
$$ LANGUAGE plpgsql;
CREATE INDEX IF NOT EXISTS question_categories_question_index ON question_categories (question_id);
CREATE INDEX IF NOT EXISTS answers_question_id_index ON answers (question_id);