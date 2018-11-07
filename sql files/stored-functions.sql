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

-- Added description, image_path , available, active boolean to entry
-- FInd out how to put constraints => bid>current_bid/starting_bid


-- resetting entry's current_quantity back to total_quantity
SET current_quantity = CASE
        WHEN current_quantity <> total_quantity THEN total_quantity
        ELSE current_quantity
        END;