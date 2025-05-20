-- List all customer purchases with artwork and salesperson details
SELECT 
    C.FirstName AS CustomerFirstName,
    C.LastName AS CustomerLastName,
    A.ArtworkName,
    A.Style,
    A.Price,
    AO.DateOrder,
    S.FirstName AS StaffFirstName,
    S.LastName AS StaffLastName
FROM 
    CUSTOMER C
JOIN ARTWORK_ORDER AO ON C.CustomerID = AO.CustomerID
JOIN PURCHASED_ARTWORK PA ON AO.ArtworkOrderNumber = PA.ArtworkOrderNumber
JOIN ARTWORK A ON PA.ArtworkNumber = A.ArtworkNumber
JOIN SALESPERSON S ON AO.StaffCode = S.StaffCode
ORDER BY 
    AO.DateOrder DESC;
