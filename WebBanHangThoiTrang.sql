USE [master]
GO
/****** Object:  Database [WebBanHangThoiTrang]    Script Date: 6/10/2023 12:44:05 AM ******/
CREATE DATABASE [WebBanHangThoiTrang]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'WebBanHangThoiTrang', FILENAME = N'D:\SQL\MSSQL15.SQLEXPRESS\MSSQL\DATA\WebBanHangThoiTrang.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'WebBanHangThoiTrang_log', FILENAME = N'D:\SQL\MSSQL15.SQLEXPRESS\MSSQL\DATA\WebBanHangThoiTrang_log.ldf' , SIZE = 8192KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
 WITH CATALOG_COLLATION = DATABASE_DEFAULT
GO
ALTER DATABASE [WebBanHangThoiTrang] SET COMPATIBILITY_LEVEL = 150
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [WebBanHangThoiTrang].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [WebBanHangThoiTrang] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [WebBanHangThoiTrang] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [WebBanHangThoiTrang] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [WebBanHangThoiTrang] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [WebBanHangThoiTrang] SET ARITHABORT OFF 
GO
ALTER DATABASE [WebBanHangThoiTrang] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [WebBanHangThoiTrang] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [WebBanHangThoiTrang] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [WebBanHangThoiTrang] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [WebBanHangThoiTrang] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [WebBanHangThoiTrang] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [WebBanHangThoiTrang] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [WebBanHangThoiTrang] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [WebBanHangThoiTrang] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [WebBanHangThoiTrang] SET  DISABLE_BROKER 
GO
ALTER DATABASE [WebBanHangThoiTrang] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [WebBanHangThoiTrang] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [WebBanHangThoiTrang] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [WebBanHangThoiTrang] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [WebBanHangThoiTrang] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [WebBanHangThoiTrang] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [WebBanHangThoiTrang] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [WebBanHangThoiTrang] SET RECOVERY SIMPLE 
GO
ALTER DATABASE [WebBanHangThoiTrang] SET  MULTI_USER 
GO
ALTER DATABASE [WebBanHangThoiTrang] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [WebBanHangThoiTrang] SET DB_CHAINING OFF 
GO
ALTER DATABASE [WebBanHangThoiTrang] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [WebBanHangThoiTrang] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [WebBanHangThoiTrang] SET DELAYED_DURABILITY = DISABLED 
GO
ALTER DATABASE [WebBanHangThoiTrang] SET ACCELERATED_DATABASE_RECOVERY = OFF  
GO
ALTER DATABASE [WebBanHangThoiTrang] SET QUERY_STORE = OFF
GO
USE [WebBanHangThoiTrang]
GO
/****** Object:  Table [dbo].[tb_Category]    Script Date: 6/10/2023 12:44:05 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tb_Category](
	[CateId] [int] IDENTITY(1,1) NOT NULL,
	[CateTitle] [nvarchar](150) NOT NULL,
	[CateDescription] [nvarchar](max) NULL,
	[CateImage] [nvarchar](250) NULL,
	[CateCreateDate] [datetime] NOT NULL,
	[CateModifiedDate] [datetime] NOT NULL,
	[CateAlias] [nvarchar](150) NOT NULL,
 CONSTRAINT [PK_tb_ProductCategory] PRIMARY KEY CLUSTERED 
(
	[CateId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tb_Comment]    Script Date: 6/10/2023 12:44:05 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tb_Comment](
	[CmtId] [int] IDENTITY(1,1) NOT NULL,
	[CusId] [int] NOT NULL,
	[ProdId] [int] NOT NULL,
	[CmtTitle] [nvarchar](150) NOT NULL,
	[CmtDate] [datetime] NOT NULL,
	[CmtDescription] [nvarchar](max) NULL,
	[CmtStatus] [bit] NOT NULL,
 CONSTRAINT [PK_tb_FeedBack] PRIMARY KEY CLUSTERED 
(
	[CmtId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tb_Customer]    Script Date: 6/10/2023 12:44:05 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tb_Customer](
	[CusId] [int] IDENTITY(1,1) NOT NULL,
	[CusUser] [nvarchar](150) NOT NULL,
	[CusPass] [nvarchar](150) NOT NULL,
	[CusName] [nvarchar](150) NOT NULL,
	[CusPhone] [nvarchar](50) NOT NULL,
	[CusAddress] [nvarchar](max) NOT NULL,
	[CusEmail] [nvarchar](150) NOT NULL,
	[CusCreateDate] [datetime] NOT NULL,
	[CusModifiedDate] [datetime] NOT NULL,
	[CusIsActive] [bit] NOT NULL,
 CONSTRAINT [PK_tb_Customer] PRIMARY KEY CLUSTERED 
(
	[CusId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY],
 CONSTRAINT [IX_tb_Customer] UNIQUE NONCLUSTERED 
(
	[CusUser] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY],
 CONSTRAINT [IX_tb_Customer_1] UNIQUE NONCLUSTERED 
(
	[CusPhone] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tb_Menu]    Script Date: 6/10/2023 12:44:05 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tb_Menu](
	[MenuId] [int] IDENTITY(1,1) NOT NULL,
	[MenuName] [nvarchar](50) NOT NULL,
	[MenuCreateDate] [datetime] NOT NULL,
	[MenuModifiedDate] [datetime] NOT NULL,
 CONSTRAINT [PK_tb_Menu] PRIMARY KEY CLUSTERED 
(
	[MenuId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tb_Order]    Script Date: 6/10/2023 12:44:05 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tb_Order](
	[OrderId] [int] IDENTITY(1,1) NOT NULL,
	[OrderCode] [nvarchar](max) NOT NULL,
	[CusId] [int] NOT NULL,
	[PayId] [int] NOT NULL,
	[OrderTotalAmount] [decimal](18, 2) NOT NULL,
	[OrderQuantity] [int] NOT NULL,
	[OrderCreateDate] [datetime] NOT NULL,
	[OrderStatus] [bit] NOT NULL,
 CONSTRAINT [PK_tb_Order] PRIMARY KEY CLUSTERED 
(
	[OrderId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tb_OrderDetail]    Script Date: 6/10/2023 12:44:05 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tb_OrderDetail](
	[OrderId] [int] NOT NULL,
	[ProdId] [int] NOT NULL,
	[OrdQuantity] [int] NOT NULL,
	[OrdPrice] [decimal](18, 2) NOT NULL,
 CONSTRAINT [PK_tb_OrderDetail] PRIMARY KEY CLUSTERED 
(
	[OrderId] ASC,
	[ProdId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tb_PaymentMethod]    Script Date: 6/10/2023 12:44:05 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tb_PaymentMethod](
	[PayId] [int] IDENTITY(1,1) NOT NULL,
	[PayType] [nvarchar](50) NOT NULL,
 CONSTRAINT [PK_tb_PaymentMethod] PRIMARY KEY CLUSTERED 
(
	[PayId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tb_Product]    Script Date: 6/10/2023 12:44:05 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tb_Product](
	[ProdId] [int] IDENTITY(1,1) NOT NULL,
	[UserId] [int] NOT NULL,
	[ProdTitle] [nvarchar](250) NOT NULL,
	[ProdDescription] [nvarchar](max) NULL,
	[ProdDetail] [nvarchar](max) NULL,
	[ProdImage] [nvarchar](250) NULL,
	[ProdPrice] [decimal](18, 2) NOT NULL,
	[ProdPriceSale] [decimal](18, 2) NULL,
	[ProdQuantity] [int] NOT NULL,
	[ProdIsSale] [bit] NOT NULL,
	[ProdIsHot] [bit] NOT NULL,
	[CateId] [int] NOT NULL,
	[ProdCreateDate] [datetime] NOT NULL,
	[ProdModifiedDate] [datetime] NOT NULL,
	[ProdAlias] [nvarchar](250) NOT NULL,
	[ProdIsActive] [bit] NOT NULL,
	[ProdViewCount] [int] NOT NULL,
 CONSTRAINT [PK_tb_Product] PRIMARY KEY CLUSTERED 
(
	[ProdId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tb_ProductImage]    Script Date: 6/10/2023 12:44:05 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tb_ProductImage](
	[Id] [int] IDENTITY(1,1) NOT NULL,
	[ProdId] [int] NOT NULL,
	[Image] [nvarchar](max) NOT NULL,
	[IsDefault] [bit] NOT NULL,
 CONSTRAINT [PK_tb_ProductImage] PRIMARY KEY CLUSTERED 
(
	[Id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tb_Role]    Script Date: 6/10/2023 12:44:05 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tb_Role](
	[RoleId] [int] IDENTITY(1,1) NOT NULL,
	[RoleName] [nvarchar](150) NOT NULL,
	[RoleDescription] [nvarchar](250) NULL,
 CONSTRAINT [PK_tb_Role] PRIMARY KEY CLUSTERED 
(
	[RoleId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tb_RoleUser]    Script Date: 6/10/2023 12:44:05 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tb_RoleUser](
	[Id] [int] IDENTITY(1,1) NOT NULL,
	[UserId] [int] NULL,
	[RoleId] [int] NULL,
 CONSTRAINT [PK_tb_RoleUser] PRIMARY KEY CLUSTERED 
(
	[Id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tb_User]    Script Date: 6/10/2023 12:44:05 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tb_User](
	[UserId] [int] IDENTITY(1,1) NOT NULL,
	[UserName] [nvarchar](50) NOT NULL,
	[UserPassword] [nvarchar](50) NOT NULL,
	[UserPhone] [nvarchar](50) NOT NULL,
	[UserEmail] [nvarchar](150) NULL,
	[UserCreateDate] [datetime] NOT NULL,
	[UserModifiedDate] [datetime] NOT NULL,
 CONSTRAINT [PK_tb_User] PRIMARY KEY CLUSTERED 
(
	[UserId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER TABLE [dbo].[tb_Comment] ADD  CONSTRAINT [DF_tb_Comment_CmtStatus]  DEFAULT ((1)) FOR [CmtStatus]
GO
ALTER TABLE [dbo].[tb_Customer] ADD  CONSTRAINT [DF_tb_Customer_CusIsActive]  DEFAULT ((1)) FOR [CusIsActive]
GO
ALTER TABLE [dbo].[tb_Order] ADD  CONSTRAINT [DF_tb_Order_OrderStatus]  DEFAULT ((0)) FOR [OrderStatus]
GO
ALTER TABLE [dbo].[tb_Product] ADD  CONSTRAINT [DF_tb_Product_ProdIsSale]  DEFAULT ((0)) FOR [ProdIsSale]
GO
ALTER TABLE [dbo].[tb_Product] ADD  CONSTRAINT [DF_tb_Product_ProdIsHot]  DEFAULT ((0)) FOR [ProdIsHot]
GO
ALTER TABLE [dbo].[tb_Product] ADD  CONSTRAINT [DF_tb_Product_IsActive]  DEFAULT ((1)) FOR [ProdIsActive]
GO
ALTER TABLE [dbo].[tb_ProductImage] ADD  CONSTRAINT [DF_tb_ProductImage_IsDefault]  DEFAULT ((1)) FOR [IsDefault]
GO
ALTER TABLE [dbo].[tb_Comment]  WITH CHECK ADD  CONSTRAINT [FK_tb_Comment_tb_Customer] FOREIGN KEY([CusId])
REFERENCES [dbo].[tb_Customer] ([CusId])
GO
ALTER TABLE [dbo].[tb_Comment] CHECK CONSTRAINT [FK_tb_Comment_tb_Customer]
GO
ALTER TABLE [dbo].[tb_Comment]  WITH CHECK ADD  CONSTRAINT [FK_tb_FeedBack_tb_Product] FOREIGN KEY([ProdId])
REFERENCES [dbo].[tb_Product] ([ProdId])
GO
ALTER TABLE [dbo].[tb_Comment] CHECK CONSTRAINT [FK_tb_FeedBack_tb_Product]
GO
ALTER TABLE [dbo].[tb_Order]  WITH CHECK ADD  CONSTRAINT [FK_tb_Order_tb_Customer] FOREIGN KEY([CusId])
REFERENCES [dbo].[tb_Customer] ([CusId])
GO
ALTER TABLE [dbo].[tb_Order] CHECK CONSTRAINT [FK_tb_Order_tb_Customer]
GO
ALTER TABLE [dbo].[tb_Order]  WITH CHECK ADD  CONSTRAINT [FK_tb_Order_tb_PaymentMethod] FOREIGN KEY([PayId])
REFERENCES [dbo].[tb_PaymentMethod] ([PayId])
GO
ALTER TABLE [dbo].[tb_Order] CHECK CONSTRAINT [FK_tb_Order_tb_PaymentMethod]
GO
ALTER TABLE [dbo].[tb_OrderDetail]  WITH CHECK ADD  CONSTRAINT [FK_tb_OrderDetail_tb_Order] FOREIGN KEY([OrderId])
REFERENCES [dbo].[tb_Order] ([OrderId])
GO
ALTER TABLE [dbo].[tb_OrderDetail] CHECK CONSTRAINT [FK_tb_OrderDetail_tb_Order]
GO
ALTER TABLE [dbo].[tb_OrderDetail]  WITH CHECK ADD  CONSTRAINT [FK_tb_OrderDetail_tb_Product] FOREIGN KEY([ProdId])
REFERENCES [dbo].[tb_Product] ([ProdId])
GO
ALTER TABLE [dbo].[tb_OrderDetail] CHECK CONSTRAINT [FK_tb_OrderDetail_tb_Product]
GO
ALTER TABLE [dbo].[tb_Product]  WITH CHECK ADD  CONSTRAINT [FK_tb_Product_tb_ProductCategory] FOREIGN KEY([CateId])
REFERENCES [dbo].[tb_Category] ([CateId])
GO
ALTER TABLE [dbo].[tb_Product] CHECK CONSTRAINT [FK_tb_Product_tb_ProductCategory]
GO
ALTER TABLE [dbo].[tb_Product]  WITH CHECK ADD  CONSTRAINT [FK_tb_Product_tb_User] FOREIGN KEY([UserId])
REFERENCES [dbo].[tb_User] ([UserId])
GO
ALTER TABLE [dbo].[tb_Product] CHECK CONSTRAINT [FK_tb_Product_tb_User]
GO
ALTER TABLE [dbo].[tb_ProductImage]  WITH CHECK ADD  CONSTRAINT [FK_tb_ProductImage_tb_Product] FOREIGN KEY([ProdId])
REFERENCES [dbo].[tb_Product] ([ProdId])
GO
ALTER TABLE [dbo].[tb_ProductImage] CHECK CONSTRAINT [FK_tb_ProductImage_tb_Product]
GO
ALTER TABLE [dbo].[tb_RoleUser]  WITH CHECK ADD  CONSTRAINT [FK_tb_RoleUser_tb_Role] FOREIGN KEY([RoleId])
REFERENCES [dbo].[tb_Role] ([RoleId])
GO
ALTER TABLE [dbo].[tb_RoleUser] CHECK CONSTRAINT [FK_tb_RoleUser_tb_Role]
GO
ALTER TABLE [dbo].[tb_RoleUser]  WITH CHECK ADD  CONSTRAINT [FK_tb_RoleUser_tb_User] FOREIGN KEY([UserId])
REFERENCES [dbo].[tb_User] ([UserId])
GO
ALTER TABLE [dbo].[tb_RoleUser] CHECK CONSTRAINT [FK_tb_RoleUser_tb_User]
GO
USE [master]
GO
ALTER DATABASE [WebBanHangThoiTrang] SET  READ_WRITE 
GO
