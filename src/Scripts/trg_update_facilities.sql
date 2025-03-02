CREATE TRIGGER trg_update_facilities
BEFORE UPDATE ON facilities
FOR EACH ROW
EXECUTE FUNCTION fn_update_timestamp();