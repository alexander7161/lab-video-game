CREATE VIEW currentRentals
AS

    SELECT *
    FROM rentals
    WHERE enddate is null;
