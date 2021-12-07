CREATE OR REPLACE FUNCTION add_question(_body JSON) RETURNS JSON AS
$$
DECLARE
    _question_id UUID;
    _answer      JSON;
BEGIN
    INSERT INTO questions (question, sort_order) VALUES ((_body ->> 'question')::TEXT,(_body ->> 'sort_order')::INT) RETURNING id INTO _question_id;

    FOR _answer IN SELECT * FROM JSON_ARRAY_ELEMENTS((_body ->> 'answers')::JSON)
        LOOP
            INSERT INTO answers (answer, question_id, is_correct) VALUES ((_answer ->> 'answer')::TEXT, _question_id,(_answer ->> 'is_correct')::BOOLEAN );
        END LOOP;
    return get_question(_question_id);
END
$$ LANGUAGE plpgsql;