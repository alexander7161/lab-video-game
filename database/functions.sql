CREATE OR REPLACE FUNCTION getextensionlimit
()
RETURNS integer AS $total$
declare
	total integer;
BEGIN
    SELECT extensionlimit
    into total
    FROM rules;
    RETURN total;
END;
$total$ LANGUAGE plpgsql;
