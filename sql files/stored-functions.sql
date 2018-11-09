--FOR PASSWORDS
CREATE FUNCTION encrypt_password()
  RETURNS TRIGGER AS
$func$
BEGIN
 NEW.passwd := md5(NEW.password);
 RETURN NEW;
END
$func$ LANGUAGE plpgsql; 

CREATE TRIGGER encrypt_userdata
BEFORE INSERT OR UPDATE ON users
FOR EACH ROW EXECUTE PROCEDURE encrypt_password();

-- ---------------

-- Added description, image_path , available, active boolean, no quantity to entry
-- FInd out how to put constraints => bid>current_bid/starting_bid