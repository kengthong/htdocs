--users
CREATE TABLE users
(
user_id serial,
username character varying(200) NOT NULL, password character varying(200) NOT NULL,
name character varying(200) NOT NULL, contact_number character varying(200) NOT NULL, email character varying(200) NOT NULL,
admin boolean NOT NULL,
PRIMARY KEY (user_id)
)
--entry
CREATE TABLE entry
(
entry_id serial,
name character varying(200) NOT NULL, location character varying(200) NOT NULL, starting_bid numeric(12, 2) NOT NULL,
current_bid numeric(12, 2) NOT NULL DEFAULT 0, owner_id integer,
total_quantity integer NOT NULL, current_quantity integer NOT NULL, bid_closing_date date NOT NULL,
loan_duration integer NOT NULL,
PRIMARY KEY (entry_id),
FOREIGN KEY owner_id REFERENCES users(user_id)
)
--bid record
CREATE TABLE bid_record
(
bid_amount numeric(12, 2) NOT NULL,
quantity integer NOT NULL,
user_id integer,
entry_id integer,
bid_id serial,
PRIMARY KEY (bid_id),
FOREIGN KEY (entry_id) REFERENCES entry(entry_id), FOREIGN KEY (user_id) REFERENCES users(user_id)
)
--borrowed_record
CREATE TABLE borrowed_record
(
record_id serial,
entry_id integer,
borrower_id integer,
start_from date NOT NULL,
return_by date NOT NULL,
returned_date date,
quantity integer NOT NULL,
borrowed_price numeric(12, 2) NOT NULL, borrower_returned boolean DEFAULT FALSE, owner_received boolean DEFAULT FALSE,
PRIMARY KEY (record_id),
FOREIGN KEY (entry_id) REFERENCES entry(entry_id), FOREIGN KEY (borrower_id) REFERENCES users(user_id)
)