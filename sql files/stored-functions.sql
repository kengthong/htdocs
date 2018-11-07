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
BEFORE INSERT ON users
EXECUTE PROCEDURE encrypt_password();

-- ---------------