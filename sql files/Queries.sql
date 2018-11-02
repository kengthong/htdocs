--User search for entries under userID
SELECT DISTINCT name, entry_id, current_bid, total_quantity, current_quantity, loan_duration, bid_closing_date
FROM entry e
WHERE userid = inputId;

--search for all available entries for bidding
SELECT DISTINCT name, entry_id, current_bid, total_quantity, current_quantity, loan_duration, bid_closing_date
FROM entry e
WHERE bid_closing_date > CURDATE()
ORDER BY bid_closing_date DESC;

--Bidding Process
--Action 1: CREATE bid record
INSERT INTO bid_record(bid_amount, quantity, user_id, entry_id) 
VALUES(bidamt, bidquantity, bidUserid, entryId);

--Action 2: Update entry - when user bids a higher bid and there exist a bid record by user on the same thing
--assumption that the bidamt is higher than the current highest bid
UPDATE bid_record SET bid_amount = bidamt, quantity = newQnt
WHERE user_id = userId
AND entry_id = entryId;

UPDATE entry SET current_bid = newBid, current_quantity = newQnt
WHERE user_id = userid
AND entry_id = entryId;

--Action 3 update entry - retract bid
DELETE FROM bid_record
WHERE user_id = userid
AND entry_id = entryId; --delete the bid

UPDATE entry SET current_bid = (
SELECT MAX(bid_amount) 
FROM bid_record 
WHERE entry_id = entryId
); -- update the current highest bid

--Accepting a bid
--Action 1: Query for highest bidder details
SELECT dISTINCT u.username, u.name, u.contact_number, e.current_bid, e.entry_id, bir.quantity
FROM users u, entry e, bid_record bir
WHERE entryID = e.entry_id
AND u.user_id = bir.user_id
AND e.entry_id = bir.entry_id
AND e.current_bid = bir.bid_bidamount;

--Action 2: create new row in borrowed record
INSERT INTO borrowed_record(entry_id, borrrower_id, start_from, returned_by, quantity, borrowed_price) 
SELECT DISTINCT e.entry_id, u.user_id, CURDATE(), CURDATE() + e.loan_duration, e.current_quantity, e.current_bid 
FROM users u, entry e, bid_record bir
WHERE entryID = e.entry_id
AND u.user_id = bir.user_id
AND e.entry_id = bir.entry_id
AND e.current_bid = bir.bid_bidamount;