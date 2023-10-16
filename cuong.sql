-- Tạo cơ sở dữ liệu
CREATE DATABASE IF NOT EXISTS WebBanHangThoiTrang;

-- Sử dụng cơ sở dữ liệu
USE WebBanHangThoiTrang;

-- Tạo bảng tb_Category
CREATE TABLE tb_Category (
    CateId INT AUTO_INCREMENT PRIMARY KEY,
    CateTitle NVARCHAR(150) NOT NULL,
    CateDescription TEXT,
    CateImage NVARCHAR(250),
    CateCreateDate DATETIME NOT NULL,
    CateModifiedDate DATETIME NOT NULL,
    CateAlias NVARCHAR(150) NOT NULL
);

-- Tạo bảng tb_Comment
CREATE TABLE tb_Comment (
    CmtId INT AUTO_INCREMENT PRIMARY KEY,
    CusId INT NOT NULL,
    ProdId INT NOT NULL,
    CmtTitle NVARCHAR(150) NOT NULL,
    CmtDate DATETIME NOT NULL,
    CmtDescription TEXT,
    CmtStatus TINYINT NOT NULL DEFAULT 1,
    FOREIGN KEY (CusId) REFERENCES tb_Customer (CusId),
    FOREIGN KEY (ProdId) REFERENCES tb_Product (ProdId)
);

-- Tạo bảng tb_Customer
CREATE TABLE tb_Customer (
    CusId INT AUTO_INCREMENT PRIMARY KEY,
    CusUser NVARCHAR(150) NOT NULL,
    CusPass NVARCHAR(150) NOT NULL,
    CusName NVARCHAR(150) NOT NULL,
    CusPhone NVARCHAR(50) NOT NULL,
    CusAddress TEXT NOT NULL,
    CusEmail NVARCHAR(150) NOT NULL,
    CusCreateDate DATETIME NOT NULL,
    CusModifiedDate DATETIME NOT NULL,
    CusIsActive TINYINT NOT NULL DEFAULT 1,
    UNIQUE KEY (CusUser),
    UNIQUE KEY (CusPhone)
);

-- Tạo bảng tb_Menu
CREATE TABLE tb_Menu (
    MenuId INT AUTO_INCREMENT PRIMARY KEY,
    MenuName NVARCHAR(50) NOT NULL,
    MenuCreateDate DATETIME NOT NULL,
    MenuModifiedDate DATETIME NOT NULL
);

-- Tạo bảng tb_Order
CREATE TABLE tb_Order (
    OrderId INT AUTO_INCREMENT PRIMARY KEY,
    OrderCode TEXT NOT NULL,
    CusId INT NOT NULL,
    PayId INT NOT NULL,
    OrderTotalAmount DECIMAL(18, 2) NOT NULL,
    OrderQuantity INT NOT NULL,
    OrderCreateDate DATETIME NOT NULL,
    OrderStatus TINYINT NOT NULL DEFAULT 0,
    FOREIGN KEY (CusId) REFERENCES tb_Customer (CusId),
    FOREIGN KEY (PayId) REFERENCES tb_PaymentMethod (PayId)
);

-- Tạo bảng tb_OrderDetail
CREATE TABLE tb_OrderDetail (
    OrderId INT NOT NULL,
    ProdId INT NOT NULL,
    OrdQuantity INT NOT NULL,
    OrdPrice DECIMAL(18, 2) NOT NULL,
    PRIMARY KEY (OrderId, ProdId),
    FOREIGN KEY (OrderId) REFERENCES tb_Order (OrderId),
    FOREIGN KEY (ProdId) REFERENCES tb_Product (ProdId)
);

-- Tạo bảng tb_PaymentMethod
CREATE TABLE tb_PaymentMethod (
    PayId INT AUTO_INCREMENT PRIMARY KEY,
    PayType NVARCHAR(50) NOT NULL
);

-- Tạo bảng tb_Product
CREATE TABLE tb_Product (
    ProdId INT AUTO_INCREMENT PRIMARY KEY,
    UserId INT NOT NULL,
    ProdTitle NVARCHAR(250) NOT NULL,
    ProdDescription TEXT,
    ProdDetail TEXT,
    ProdImage NVARCHAR(250),
    ProdPrice DECIMAL(18, 2) NOT NULL,
    ProdPriceSale DECIMAL(18, 2),
    ProdQuantity INT NOT NULL,
    ProdIsSale TINYINT NOT NULL DEFAULT 0,
    ProdIsHot TINYINT NOT NULL DEFAULT 0,
    CateId INT NOT NULL,
    ProdCreateDate DATETIME NOT NULL,
    ProdModifiedDate DATETIME NOT NULL,
    ProdAlias NVARCHAR(250) NOT NULL,
    ProdIsActive TINYINT NOT NULL DEFAULT 1,
    ProdViewCount INT NOT NULL,
    FOREIGN KEY (UserId) REFERENCES tb_User (UserId),
    FOREIGN KEY (CateId) REFERENCES tb_Category (CateId)
);

-- Tạo bảng tb_ProductImage
CREATE TABLE tb_ProductImage (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    ProdId INT NOT NULL,
    Image TEXT NOT NULL,
    IsDefault TINYINT NOT NULL DEFAULT 1,
    FOREIGN KEY (ProdId) REFERENCES tb_Product (ProdId)
);

-- Tạo bảng tb_Role
CREATE TABLE tb_Role (
    RoleId INT AUTO_INCREMENT PRIMARY KEY,
    RoleName NVARCHAR(150) NOT NULL,
    RoleDescription NVARCHAR(250)
);

-- Tạo bảng tb_RoleUser
CREATE TABLE tb_RoleUser (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    UserId INT,
    RoleId INT,
    FOREIGN KEY (UserId) REFERENCES tb_User (UserId),
    FOREIGN KEY (RoleId) REFERENCES tb_Role (RoleId)
);

-- Tạo bảng tb_User
CREATE TABLE tb_User (
    UserId INT AUTO_INCREMENT PRIMARY KEY,
    UserName NVARCHAR(50) NOT NULL,
    UserPassword NVARCHAR(50) NOT NULL,
    UserPhone NVARCHAR(50) NOT NULL,
    UserEmail NVARCHAR(150),
    UserCreateDate DATETIME NOT NULL,
    UserModifiedDate DATETIME NOT NULL
);
ALTER TABLE tb_User
MODIFY UserPhone NVARCHAR(150);


-- Sử dụng cơ sở dữ liệu
USE WebBanHangThoiTrang;

