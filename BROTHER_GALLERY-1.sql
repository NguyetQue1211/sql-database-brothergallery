
-- BrotherGallery Database

USE BrotherGallery;

CREATE TABLE CUSTOMER (
	CustomerID   		Integer 	      	NOT NULL AUTO_INCREMENT,
	FirstName  	    	Char (255) 	    	NOT NULL,
	LastName			Char (255)			NOT NULL,
	DoB					DATE				NULL,
	EmailAddress   	    Char (255) 	    	NOT NULL,
	Phone  			    Char(12) 	       	NOT NULL,
	CONSTRAINT 		    CUSTOMER_PK   PRIMARY KEY (CustomerID)
	);

CREATE TABLE ARTWORK (
	ArtworkNumber	    Integer		    NOT NULL AUTO_INCREMENT,
	ArtworkName   	    Char(255) 	    NOT NULL,
	DateCreated         DATE 	        NULL,
	Style  	            Char(255)  	    NULL,
	Price		        Decimal(10,2)	NOT NULL,
	CONSTRAINT 			ARTWORK_PK 	PRIMARY KEY (ArtworkNumber)
	);  

CREATE TABLE SALESPERSON (
	StaffCode			Char(255)	NOT NULL UNIQUE,
	FirstName   		Char(255) 	NOT NULL,
	LastName            Char(255) 	NOT NULL,
	CONSTRAINT 		    SALESPERSON_PK 	PRIMARY KEY (StaffCode)
	); 

CREATE TABLE ARTWORK_ORDER (
	ArtworkOrderNumber	Integer		       	NOT NULL UNIQUE,
	DateOrder	        DATE  	    	    NULL,
	Total	  	    	DECIMAL(10,2)		NOT NULL,
    CustomerID          Integer             NOT NULL,
	StaffCode			Char(255)			NOT NULL,
    CONSTRAINT 		    ARTWORK_ORDER_PK 	PRIMARY KEY (ArtworkOrderNumber),
	CONSTRAINT 		    ARTWORK_ORDER_FK 	FOREIGN KEY (CustomerID)
                        REFERENCES CUSTOMER (CustomerID),
	CONSTRAINT 		    ARTWORK_ORDER_SALEPERSON_FK 	FOREIGN KEY (StaffCode)
                        REFERENCES SALESPERSON (StaffCode)
	);

CREATE TABLE PURCHASED_ARTWORK (
	ArtworkOrderNumber		Integer		NOT NULL,
	ArtworkNumber   		Integer 	NOT NULL,
	CONSTRAINT 				PURCHASED_ARTWORK_PK 	PRIMARY KEY (ArtworkOrderNumber, ArtworkNumber), 
    CONSTRAINT 		   		PURCHASED_ARTWORK_FK1 	FOREIGN KEY (ArtworkOrderNumber)
                        	REFERENCES ARTWORK_ORDER(ArtworkOrderNumber), 
	CONSTRAINT 		   		PURCHASED_ARTWORK_FK2 	FOREIGN KEY (ArtworkNumber)
                        	REFERENCES ARTWORK(ArtworkNumber)					
	);





-- INSERT CUSTOMER Data
INSERT INTO CUSTOMER (FirstName, LastName, DoB, EmailAddress, Phone) VALUES (
	'Laura','Phan', '2000-11-12','LauraPhan@gmail.com','0344965758');
INSERT INTO CUSTOMER (FirstName, LastName, DoB, EmailAddress, Phone) VALUES (
	'Lau','Marcia','1997-05-07','LauMarcia@gmail.com','0788972912');
INSERT INTO CUSTOMER (FirstName, LastName, DoB, EmailAddress, Phone) VALUES (
	'Kevin','Hart','1967-02-20','KevinHart@gmail.com','0876164545');
INSERT INTO CUSTOMER (FirstName, LastName, DoB, EmailAddress, Phone) VALUES (
	'Greene','Grace','1991-02-26','GreeneGrace@gmail.com','0187310938');
INSERT INTO CUSTOMER (FirstName, LastName, DoB, EmailAddress, Phone) VALUES (
	'Ariana','Grand','1982-10-27','Ariana@gmail.com','0783465719');


-- INSERT ARTWORK data
INSERT INTO ARTWORK (ArtworkName, DateCreated, Style, Price) VALUES (
	'Bathers at La Grenouillere', '1990-05-19', 'Landscape', '45000');
INSERT INTO ARTWORK (ArtworkName, DateCreated, Style, Price) VALUES (
	'Mr and Mrs Andrews', '1975-09-20', 'portrait', '10000');
INSERT INTO ARTWORK (ArtworkName, DateCreated, Style, Price) VALUES (
	'Venus and Mars', '2001-10-30', 'cosmos', '70000');
INSERT INTO ARTWORK (ArtworkName, DateCreated, Style, Price) VALUES (
	'Sunflowers', '2010-10-02', 'Landscape', '35000');
INSERT INTO ARTWORK (ArtworkName, DateCreated, Style, Price) VALUES (
	'Self Portrait at the Age of 34', '1980-10-22', 'portrait', '87000');
INSERT INTO ARTWORK (ArtworkName, DateCreated, Style, Price) VALUES (
	'The Battle of San Romano', '1999-01-01', 'History', '100000');
INSERT INTO ARTWORK (ArtworkName, DateCreated, Style, Price) VALUES (
	"The Stonemason's Yard", '2001-06-13', 'Landscape', '72000');

-- INSERT SALESPERSON data
INSERT INTO SALESPERSON VALUES (
	'BGS01', 'Lam', 'Ngo');
INSERT INTO SALESPERSON VALUES (
	'BGS02', 'Nguyen', 'Nguyen');

-- INSERT ARTWORK_ORDER data
INSERT INTO ARTWORK_ORDER VALUES (
	10001, '2021-05-21', '35000', 1, 'BGS01');
INSERT INTO ARTWORK_ORDER VALUES (
	10002, '2021-05-30', '45000', 3, 'BGS01');
INSERT INTO ARTWORK_ORDER VALUES (
	10003, '2021-09-22', '70000', 2, 'BGS02');
INSERT INTO ARTWORK_ORDER VALUES (
	10004, '2021-11-30', '10000', 5, 'BGS01');
INSERT INTO ARTWORK_ORDER VALUES (
	10005, '2022-01-10', '100000', 4, 'BGS02');

-- INSERT PURCHASED_ARTWORK data
INSERT INTO PURCHASED_ARTWORK VALUES (
	10001, 4);
INSERT INTO PURCHASED_ARTWORK VALUES (
	10002, 1);
INSERT INTO PURCHASED_ARTWORK VALUES (
	10003, 3);
INSERT INTO PURCHASED_ARTWORK VALUES (
	10004, 2);





-- LEVEL C.1
-- Write a view in your database that makes it easy to access some 
-- particularly useful collection of data or particularly painful sql code

CREATE VIEW PurchasingOfCustomer AS  
SELECT C.*, A.ArtworkName, A.DateCreated, A.Style, A.Price, AO.DateOrder
FROM CUSTOMER C, ARTWORK_ORDER AO, PURCHASED_ARTWORK PA, ARTWORK A
WHERE C.CustomerID = AO.CustomerID
	AND   AO.ArtworkOrderNumber = PA.ArtworkOrderNumber
	AND   PA.ArtworkNumber = A.ArtworkNumber
GROUP BY C.CustomerID



-- LEVEL C.2
DELIMITER //

CREATE PROCEDURE DeletePurchasedArtwork
	(IN		varArtworkOrderNumber		int, 
	 IN 	varArtworkNumber			int)

BEGIN

	DECLARE	varRowCount			  Int;

	-- Check to see if the PURCHASED_ARTWORK has more than one artwork.
	SELECT	COUNT(*) INTO varRowCount
	FROM		PURCHASED_ARTWORK;

	-- IF varRowCount < 2 THEN do NOT delete the artwork.
	IF (varRowCount < 2)
		THEN
		SELECT 'The PURCHASED_ARTWORK has only one ARTWORK.'
			AS	DeletePurchasedArtworkResultsDeleteDenied;
		ROLLBACK;

	ELSE

	-- IF varRowCount = 2 or varRowCount > 2 THEN DELETE the selected Artwork.
	-- Start transaction - Rollback everything if unable to complete it.
	START TRANSACTION;

		-- DELETE the PURCHASED ARTWORK.
	DELETE FROM PURCHASED_ARTWORK
	WHERE	ArtworkOrderNumber = varArtworkOrderNumber
	AND 	ArtworkNumber = varArtworkNumber;

		-- Commit the Transaction
	COMMIT;

		-- The transaction is completed. Print message
	SELECT 'The PURCHASED ARTWORK is deleted.'
		AS DeletePurchasedArtworkResultsDeleteOccured;

	END IF;

END;
//

DELIMITER ;


-- /* To test this procedure, use
-- (1)	To delete a purchased_order

-- CALL DeletePurchasedArtwork (10001, 4);
-- CALL DeletePurchasedArtwork (10002, 1);
-- CALL DeletePurchasedArtwork (10003, 3);

-- (2)	To generate an error message
-- CALL DeletePurchasedArtwork (10004, 2);

