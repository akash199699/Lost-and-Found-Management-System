-- Users Table
CREATE TABLE Users (
    UserID INT PRIMARY KEY,
    Username VARCHAR(50),
    Password VARCHAR(50),
    Email VARCHAR(100),
    OtherInfo VARCHAR(255)
);

-- LostItems Table
CREATE TABLE LostItems (
    LostItemID INT PRIMARY KEY,
    UserID INT,
    ItemName VARCHAR(100),
    Description TEXT,
    DateLost DATE,
    LocationLost VARCHAR(100),
    Status VARCHAR(20),
    RewardOffered DECIMAL(10, 2),
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);

-- FoundItems Table
CREATE TABLE FoundItems (
    FoundItemID INT PRIMARY KEY,
    UserID INT,
    LostItemID INT,
    DateFound DATE,
    LocationFound VARCHAR(100),
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (LostItemID) REFERENCES LostItems(LostItemID)
);

-- ItemCategories Table
CREATE TABLE ItemCategories (
    CategoryID INT PRIMARY KEY,
    CategoryName VARCHAR(50),
    Description TEXT
);

-- Transactions Table
CREATE TABLE Transactions (
    TransactionID INT PRIMARY KEY,
    UserID INT,
    ItemID INT,
    TransactionType VARCHAR(20),
    TransactionDate DATE,
    TransactionLocation VARCHAR(100),
    RewardReceived DECIMAL(10, 2),
    AdditionalDetails TEXT,
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (ItemID) REFERENCES LostItems(LostItemID) ON DELETE CASCADE,
    FOREIGN KEY (ItemID) REFERENCES FoundItems(FoundItemID) ON DELETE CASCADE
);
