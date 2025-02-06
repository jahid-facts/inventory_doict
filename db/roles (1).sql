-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2018 at 10:00 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `roles` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `description`, `roles`, `status`, `created`, `modified`) VALUES
(1, 'Admin', 'Admin', '{"BrandsController":{"index":"index","view":"0","add":"add","getbrand":"getbrand","edit":"edit","delete":"delete"},"CartsController":{"index":"index","view":"view","add":"add","edit":"edit","delete":"delete"},"CategoriesController":{"index":"index","indexsub":"indexsub","getsubcategory":"getsubcategory","view":"view","add":"add","addsub":"addsub","edit":"edit","editsub":"editsub","delete":"delete","producttree":"producttree","getCategory":"getCategory","code":"code","scode":"scode"},"ColorsController":{"index":"index","view":"view","add":"add","getcolor":"getcolor","edit":"edit","delete":"delete"},"DamagesController":{"index":"index","view":"view","add":"add","edit":"edit","delete":"delete"},"DeliveriesController":{"index":"index","returnrequisition":"returnrequisition","report":"report","view":"view","proreturn":"proreturn","add":"add","edit":"edit","delete":"delete","deliveryview":"deliveryview"},"DeliverydetailsController":{"index":"index","view":"view","add":"add","edit":"edit","delete":"delete","report":"report"},"DepartmentsController":{"index":"index","view":"view","add":"add","edit":"edit","delete":"delete"},"DesignationsController":{"index":"index","view":"view","add":"add","edit":"edit","delete":"delete"},"LogsController":{"index":"index","delete":"delete","deleteleft":"deleteleft"},"MeasuresController":{"index":"index","view":"view","add":"add","edit":"edit","delete":"delete"},"OrdersController":{"index":"index","view":"view","viewprint":"viewprint","add":"add","edit":"edit","delete":"delete"},"PagesController":{"display":"display","index":"index","proceedorder":"proceedorder"},"ProductsController":{"index":"index","padjustment":"padjustment","view":"view","add":"add","addmodal":"addmodal","getprice":"getprice","getproduct":"getproduct","edit":"edit","delete":"delete","code":"code","scode":"scode","pascode":"pascode","orders":"orders","cart":"cart","dropdown":"dropdown"},"ProfilesController":{"index":"index","view":"view","add":"add","edit":"edit","delete":"delete"},"PurchasedetailsController":{"index":"index","purchasereport":"purchasereport","view":"view","add":"add","edit":"edit","delete":"delete"},"PurchasesController":{"index":"index","purchasereport":"purchasereport","view":"view","checkStock":"checkStock","add":"add","edit":"edit","delete":"delete"},"RequisitiondetailsController":{"index":"index","requisitionreport":"requisitionreport","requisitionreject":"requisitionreject","view":"view","add":"add","edit":"edit","delete":"delete"},"RequisitionretunrsController":{"index":"index","view":"view","add":"add","edit":"edit","delete":"delete"},"RequisitionreturnsController":{"index":"index","view":"view","add":"add","edit":"edit","delete":"delete"},"RequisitionsController":{"index":"index","requisitionreport":"requisitionreport","view":"view","viewr":"viewr","add":"add","add1":"add1","edit":"edit","getreject":"getreject","getapprove":"getapprove","delete":"delete","delivery":"delivery","dashboard":"dashboard","dashboardstorekeeper":"dashboardstorekeeper","requisitionapproved":"requisitionapproved","requisitionapprove":"requisitionapprove","requisitiondelivery":"requisitiondelivery","requisitionreceivedd":"requisitionreceivedd","requisitionreceived":"requisitionreceived","requisitionreject":"requisitionreject","requisitionpending":"requisitionpending"},"RolesController":{"index":"index","view":"view","add":"add","edit":"edit","delete":"delete"},"SettingsController":{"index":"index","view":"view","add":"add","edit":"edit","delete":"delete","approvemail":"approvemail"},"SizesController":{"index":"index","view":"view","add":"add","getsize":"getsize","addsize":"addsize","edit":"edit","delete":"delete"},"StockacrchivesController":{"index":"index","view":"view","add":"add","edit":"edit","delete":"delete"},"StocksController":{"index":"index","stock":"stock","reorderlist":"reorderlist","stockreport":"stockreport","datewisestock":"datewisestock","stockarchive":"stockarchive","view":"view","add":"add","edit":"edit","delete":"delete","stockrequisition":"stockrequisition","atcrequisition":"atcrequisition","atcrequisitionCustome":"atcrequisitionCustome","availablestock":"availablestock","requsition":"requsition","dashboardrequisitioner":"dashboardrequisitioner","repeatorder":"repeatorder","getcategory":"getcategory","getcategorycart":"getcategorycart","getbalance":"getbalance"},"SuppliersController":{"index":"index","view":"view","add":"add","edit":"edit","delete":"delete"},"UsersController":{"login":"login","index":"index","view":"view","cp":"cp","add":"add","edit":"edit","delete":"delete","logout":"logout","sudashboard":"sudashboard","forgetpassword":"forgetpassword","fp":"fp","activep":"activep"}}', 1, '2018-03-03 00:00:00', '2018-03-03 14:43:08'),
(2, 'Storekeeper', 'Storekeeper', '', 1, '2018-03-03 00:00:00', '2018-03-03 00:00:00'),
(3, 'Requisitioner', 'Requisitioner', '', 1, '2018-03-03 00:00:00', '2018-03-03 00:00:00'),
(4, 'Super Admin', 'Super Admin', '', 1, '2018-03-03 00:00:00', '2018-03-03 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
