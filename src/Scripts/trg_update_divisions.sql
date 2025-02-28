CREATE TRIGGER trg_update_divisions
BEFORE UPDATE ON divisions
FOR EACH ROW
EXECUTE FUNCTION fn_update_timestamp();