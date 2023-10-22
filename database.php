CREATE TABLE IF NOT EXISTS `User` (
  `UserId` int NOT NULL AUTO_INCREMENT,
  `UserName` varchar(200) NOT NULL,
  `UserPassword` varchar(200) NOT NULL,
  `UserPhone` varchar(200) ,
  `UserEmail` varchar(200) NOT NULL,
  `UserRole` tinyint  DEFAULT 0,
  `UserStatus` tinyint  DEFAULT 1,
  `UserCreateDate` timestamp  DEFAULT CURRENT_TIMESTAMP,
  `UserModifiedDate` timestamp  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`UserId`)
);

 -- Bảng Role:
 CREATE TABLE IF NOT EXISTS `Role` (
  `RoleId` int NOT NULL AUTO_INCREMENT,
  `RoleName` varchar(200) NOT NULL,
  `RoleDescription` varchar(255) NOT NULL,
  PRIMARY KEY (`RoleId`)
);

-- Bảng RoleUser:
CREATE TABLE IF NOT EXISTS `RoleUser` (
  `RoleUserId` int NOT NULL AUTO_INCREMENT,
  `RoleId` int NOT NULL,
  `UserId` int NOT NULL,
  PRIMARY KEY (`RoleUserId`),
  FOREIGN KEY (`RoleId`) REFERENCES `Role` (`RoleId`),
  FOREIGN KEY (`UserId`) REFERENCES `User` (`UserId`)
) ;


-- Bảng Menu:
CREATE TABLE `Menu` (
  `MenuId` int NOT NULL AUTO_INCREMENT,
  `MenuName` varchar(50) NOT NULL,
  `MenuCreateDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `MenuModifiedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`MenuId`)
) ;


-- Bảng Customer:
CREATE TABLE IF NOT EXISTS `Customer` (
  `CusId` int NOT NULL AUTO_INCREMENT,
  `CusUserName` varchar(100) NOT NULL,
  `CusPassWord` varchar(150) not null,
  `CusName` nvarchar(150) not null,
  `CusEmail` varchar(250) NOT NULL,
  `CusPhone` varchar(20) NOT NULL,
  `CusAddress` varchar(250) NOT NULL,
  `CusStatus` tinyint not null default 1,
  `CusCreateDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CusModifiedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`CusId`)
);

-- Bảng PaymentMethod
CREATE TABLE IF NOT EXISTS `PaymentMethod` (
  `PayId` int NOT NULL AUTO_INCREMENT,
  `PayType` varchar(50) NOT NULL,
  PRIMARY KEY (`PayId`)
); 

-- Bảng Category:
CREATE TABLE IF NOT EXISTS `Category` (
  `CateId` int NOT NULL AUTO_INCREMENT,
  `CateName` varchar(150) NOT NULL,
  `CateDescription` varchar(250) NOT NULL,
  `CateImage` nvarchar(250) not null, 
  `CateCreateDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CateModifiedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `CateStatus` tinyint NOT NULL DEFAULT 1,
  PRIMARY KEY (`CateId`)
);

-- Bảng product:
CREATE TABLE IF NOT EXISTS `Product` (
  `ProdId` int NOT NULL AUTO_INCREMENT,
  `ProdName` varchar(250) NOT NULL,
  `ProdDescription` varchar(4000) NOT NULL,
  `ProdImage` varchar(250) NOT NULL,
  `ProdPrice` decimal(18, 2) NOT NULL,
  `ProdPriceSale` decimal(18, 2) not null,
  `ProdQuantity` int NOT NULL,
  `ProdIsSale` tinyint NOT NULL DEFAULT 0,
  `ProdIsHot` tinyint NOT NULL DEFAULT 0,
  `CateId` int NOT NULL,
  `UserId` int NOT NULL,
  `ProdViewCount` int not null,
  `ProdCreateDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ProdModifiedDate`  timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ProdId`),
  FOREIGN KEY (`CateId`) REFERENCES `Category` (`CateId`),
  FOREIGN KEY (`UserId`) REFERENCES `User` (`UserId`)
);


-- Bảng ProductImage:
CREATE TABLE IF NOT EXISTS `ProductImage` (
  `ProdImageId` int NOT NULL AUTO_INCREMENT,
  `ProdId` int NOT NULL,
  `Image` nvarchar(4000) NOT NULL,
  `IsDefault` tinyint NOT NULL DEFAULT 1,
  PRIMARY KEY (`ProdImageId`),
  FOREIGN KEY (`ProdId`) REFERENCES `Product` (`ProdId`)
);


-- Bảng Comment: 
CREATE TABLE IF NOT EXISTS `Comment` (
  `CmtId` int NOT NULL AUTO_INCREMENT,
  `CusId` int NOT NULL,
  `ProdId` int NOT NULL,
  `CmtDescription` varchar(4000) NOT NULL,
  `CmtCreateDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CmtModifiedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,
  PRIMARY KEY (`CmtId`),
  FOREIGN KEY (`CusId`) REFERENCES `Customer` (`CusId`),
  FOREIGN KEY (`ProdId`) REFERENCES `Product` (`ProdId`)
);

-- Bảng Order: 
CREATE TABLE IF NOT EXISTS `Order` (
  `OrderId` int NOT NULL AUTO_INCREMENT,
   `OrderCode` nvarchar(4000) NOT NULL,
  `CusId` int NOT NULL,
  `PayId` int not null,
  `OrderTotalPrice` decimal(18, 2) NOT NULL,
  `OrderQuantity` int NOT NULL,
  `OrderCreateDate` datetime NOT NULL,
  `OrderStatus` tinyint NOT NULL DEFAULT 0,
  PRIMARY KEY (`OrderId`),
  foreign key (`PayId`) references `PaymentMethod` (`PayId`),
  FOREIGN KEY (`CusId`) REFERENCES `Customer` (`CusId`)
);

-- Bảng OrderDetail:
CREATE TABLE IF NOT EXISTS `OrderDetail` (
  `OrderId` int NOT NULL,
  `ProdId` int NOT NULL,
  `OrdQuantity` int NOT NULL,
  `OrdPrice` decimal(18, 2) NOT NULL,
  PRIMARY KEY (`OrderId`, `ProdId`),
  FOREIGN KEY (`OrderId`) REFERENCES `Order` (`OrderId`),
  FOREIGN KEY (`ProdId`) REFERENCES `Product` (`ProdId`)
);
