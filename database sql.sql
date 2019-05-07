-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 31, 2019 at 08:23 AM
-- Server version: 5.5.61-38.13-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ellowscr_tasky`
--

-- --------------------------------------------------------

--
-- Table structure for table `available_balance`
--

CREATE TABLE `available_balance` (
  `aid` int(11) NOT NULL,
  `user_id` int(200) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(200) NOT NULL,
  `post_date` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `name`, `description`, `image`, `post_date`) VALUES
(13, 'Excepteur sint occaecat cupidatat lau', '&lt;span style=&quot;font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);&quot;&gt;lau ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur&lt;/span&gt;&lt;div&gt;&lt;span style=&quot;font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;/div&gt;&lt;div&gt;&lt;span style=&quot;font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;/div&gt;&lt;div&gt;&lt;span style=&quot;font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);&quot;&gt;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur&lt;/span&gt;&lt;span style=&quot;font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;/div&gt;', '1537879974.jpeg', '2018-09-25'),
(14, 'At vero eos et accusamus', '&lt;span style=&quot;font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);&quot;&gt;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat&lt;/span&gt;&lt;div&gt;&lt;span style=&quot;font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;/div&gt;&lt;div&gt;&lt;span style=&quot;font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);&quot;&gt;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat&lt;/span&gt;&lt;span style=&quot;font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;/div&gt;&lt;div&gt;&lt;span style=&quot;font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;/div&gt;', '1537859669.jpeg', '2018-09-25'),
(15, 'Quis autem vel eum iure reprehenderit', '&lt;span style=&quot;font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);&quot;&gt;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur&lt;/span&gt;&lt;div&gt;&lt;span style=&quot;font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;/div&gt;&lt;div&gt;&lt;span style=&quot;font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);&quot;&gt;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur&lt;/span&gt;&lt;span style=&quot;font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;/div&gt;&lt;div&gt;&lt;span style=&quot;font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;/div&gt;', '1537859715.jpeg', '2018-09-25'),
(16, 'Temporibus autem quibusdam', '&lt;span style=&quot;font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);&quot;&gt;On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted.&amp;nbsp;&lt;/span&gt;&lt;div&gt;&lt;span style=&quot;font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;/div&gt;&lt;div&gt;&lt;span style=&quot;font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);&quot;&gt;On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted.&amp;nbsp;&lt;/span&gt;&lt;span style=&quot;font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;/div&gt;', '1537860320.jpeg', '2018-09-25');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `book_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `stripe_token` varchar(500) NOT NULL,
  `payu_token` varchar(200) NOT NULL,
  `paypal_token` varchar(500) NOT NULL,
  `services_id` varchar(50) NOT NULL,
  `booking_date` date NOT NULL,
  `booking_time` varchar(50) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `booking_address` text NOT NULL,
  `booking_city` varchar(200) NOT NULL,
  `booking_pincode` varchar(100) NOT NULL,
  `booking_note` text NOT NULL,
  `user_id` int(50) NOT NULL,
  `amount_by` varchar(50) NOT NULL,
  `subtotal_amt` float NOT NULL,
  `total_amt` float NOT NULL,
  `tax_amt` float NOT NULL,
  `admin_commission` float NOT NULL,
  `payment_mode` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `reject` varchar(100) NOT NULL,
  `service_complete` int(50) NOT NULL,
  `shop_id` int(50) NOT NULL,
  `currency` varchar(50) NOT NULL,
  `curr_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`book_id`, `token`, `stripe_token`, `payu_token`, `paypal_token`, `services_id`, `booking_date`, `booking_time`, `user_email`, `booking_address`, `booking_city`, `booking_pincode`, `booking_note`, `user_id`, `amount_by`, `subtotal_amt`, `total_amt`, `tax_amt`, `admin_commission`, `payment_mode`, `status`, `reject`, `service_complete`, `shop_id`, `currency`, `curr_date`) VALUES
(87, 'KVlKaqWG6pkx4G0IPAkSrL072QLx2sF8z7a9NTIW', '', '', '', '16,4,11,12', '2018-04-18', '5', 'newuser@gmail.com', 'dfas', 'dfsa', '324', 'dfsafdsa', 18, '', 27, 30.321, 0.621, 2.7, 'paypal', 'pending', '', 0, 22, 'USD', '2018-04-16'),
(88, 'FRXivkXmJt534po1yHRvOdnW234lxJgwg9Q7XYZ0', '', '', '', '8,9', '2018-04-17', '15', 'customer@gmail.com', 'test', 'tesss', '32432', 'dfsa', 22, '', 45, 51.75, 2.25, 4.5, 'paypal', 'paid', '', 0, 40, 'USD', '2018-04-16'),
(89, 'FRXivkXmJt534po1yHRvOdnW234lxJgwg9Q7XYZ0', '', '', '', '3,8,9', '2018-04-25', '15', 'customer@gmail.com', 'fdsa', 'fdsa', '324', 'fdsa', 22, '', 55, 63.25, 2.75, 5.5, 'paypal', 'paid', '', 0, 40, 'USD', '2018-04-16'),
(90, '5JE0miUtBfEP19wGAenmwNaEa8yLlN9MQ1JYIghZ', 'tok_1CHVJvA4i5sXvQrkXfM43W6L', '', '', '3,8', '2018-04-18', '15', 'customer@gmail.com', 'test', 'dsfa', '32423', 'dfsafdsa', 22, '', 35, 40.25, 1.75, 3.5, 'stripe', 'paid', '', 0, 40, 'USD', '2018-04-16'),
(91, '5JE0miUtBfEP19wGAenmwNaEa8yLlN9MQ1JYIghZ', 'tok_1CHVfcA4i5sXvQrkcsh8zx6E', '', '', '9', '2018-04-17', '15', 'customer@gmail.com', 'test', 'fdsa', '32423', 'fdsafdsa', 22, '', 20, 23, 1, 2, 'stripe', 'paid', '', 0, 40, 'USD', '2018-04-16'),
(92, '5JE0miUtBfEP19wGAenmwNaEa8yLlN9MQ1JYIghZ', '', '', '', '3,8', '2018-04-20', '15', 'customer@gmail.com', 'test', 'test', '324234', 'test', 22, '', 35, 40.25, 1.75, 3.5, 'payumoney', 'failed', '', 0, 40, 'USD', '2018-04-16'),
(93, '5JE0miUtBfEP19wGAenmwNaEa8yLlN9MQ1JYIghZ', '', '56700c88f4b14c28264f', '', '3,8', '2018-04-26', '15', 'customer@gmail.com', 'test', 'test', '32432', 'dfdsa', 22, '', 35, 40.25, 1.75, 3.5, 'payumoney', 'paid', '', 0, 40, 'USD', '2018-04-16'),
(94, 'pUuv8RNmyuIEmujXJqmYGSynEWcbGPT6qhpHgpDh', '', '', '', '3,4,8,9,10,11,12,13,14,17', '2018-04-21', '7', 'vendor@gmail.com', 'dfsa', 'fdsa', '324', 'dfsa', 18, '', 23, 25.3, 0, 2.3, 'wallet', 'pending', '', 0, 25, 'USD', '2018-04-17'),
(95, 'r6bdAEuvGukILV5bFRHdn9sqGowQKmxJAROo31oT', '', '', '', '3,4,8,10,11,12,13,14,17', '2018-04-21', '7', 'vendor@gmail.com', 'sample address', 'madurai', '32432432', 'fsdfadsfdsafdsafsda', 18, '', 64, 70.4, 0, 6.4, 'wallet', 'paid', '', 0, 25, 'USD', '2018-04-17'),
(96, 'BivMz9MOImgd1cXTfdPGofSb0Mn0Qm05ApyXC4V7', '', '', '', '10', '2018-04-26', '11', 'seller@seller.com', 'dfsa', 'dfsa', '32423', 'dfsafdsa', 4, '', 10, 11, 0, 1, 'wallet', 'refund', 'cancelled by customer', 0, 27, 'USD', '2018-04-17'),
(97, 'fYyaeg4wt42Hk888ZTTFwB1DfQ8qtHuOYMw5BObf', '', '', '', '9,11,13', '2018-04-20', '13', 'tester@gmail.com', 'dsdds', 'dsfsf', '32432', 'fdsafdas', 25, '', 0, 0, 0, 0, 'paypal', 'pending', '', 0, 24, 'USD', '2018-04-17'),
(98, 'YuU5nxKSCDnBhvA3rx4yy30LiTY7xraetrJcCNEh', '', '', '', '3,13,14,21', '2018-04-20', '8', 'hh@hh.com', 'fda', 'dfsa', '32432', 'fdsa', 26, '', 0, 0, 0, 0, 'paypal', 'pending', '', 0, 26, 'USD', '2018-04-17'),
(99, 'WuQoO6vbU7pg1bclkrdqfgsnQBA0AA0Am63XjG4G', '', '', '', '3,4,9,11,14', '2018-04-26', '11', 'vv@gmail.com', 'dsa', 'dsa', '324', 'dfsa', 27, '', 0, 0, 0, 0, 'paypal', 'pending', '', 0, 27, 'USD', '2018-04-17'),
(100, 'cQxFT5JOCP7E5HfSdwobRDi3kVsHdxbetSMWijR1', '', '', '', '9,16,10,11', '2018-04-23', '5', 'customer@gmail.com', 'dfsa', 'fdsa', '32423', 'fdsafdsafdsa', 22, '', 112, 128.8, 5.6, 11.2, 'paypal', 'refund', 'cancelled by vendor', 0, 22, 'USD', '2018-04-18'),
(101, 'cQxFT5JOCP7E5HfSdwobRDi3kVsHdxbetSMWijR1', '', '', '', '16,3,4,11', '2018-04-23', '5', 'customer@gmail.com', 'test', 'dfas', '32432', 'dfsaf', 22, '', 23, 26.45, 1.15, 2.3, 'paypal', 'refund', 'cancelled by vendor', 0, 22, 'USD', '2018-04-18'),
(102, 'tVjgtYhT0w81xD3NPWaljDJJkmbM1rCTx6aKqBnc', 'tok_1CIAzpA4i5sXvQrkI8p8RxmZ', '', '', '8,16,21,3,4,9,12', '2018-04-18', '11', 'seller@seller.com', 'sample address', 'test', '32423', 'dfsfsadfdsa', 4, '', 234, 257.4, 0, 23.4, 'stripe', 'paid', '', 0, 23, 'USD', '2018-04-18'),
(103, 'tVjgtYhT0w81xD3NPWaljDJJkmbM1rCTx6aKqBnc', '', '', '', '4,9,11,15', '2018-04-24', '4', 'seller@seller.com', 'fdsa', 'fdsa', '32432', 'fdsafdsa', 4, '', 27, 29.7, 0, 2.7, 'wallet', 'refund', 'cancelled by customer', 0, 28, 'USD', '2018-04-18'),
(104, 'tVjgtYhT0w81xD3NPWaljDJJkmbM1rCTx6aKqBnc', '', '', '', '4,9,11,13', '2018-04-20', '16', 'seller@seller.com', 'fdsa', 'fdsa', '32423', 'fdsa', 4, '', 27, 29.7, 0, 2.7, 'wallet', 'paid', '', 0, 28, 'USD', '2018-04-18'),
(105, 'tVjgtYhT0w81xD3NPWaljDJJkmbM1rCTx6aKqBnc', 'tok_1CIDQqA4i5sXvQrk4X1g4Ozj', '', '', '20,8,11', '2018-04-26', '10', 'seller@seller.com', 'fdsa', 'fdsafdsa', '32423', 'fdsfdsa', 4, '', 60, 78, 12, 6, 'stripe', 'refund', 'cancelled by customer', 0, 31, 'USD', '2018-04-18'),
(106, '5NkIt30bTDMnmBXNIxVifi5esuKgjNc0Pv8OB7vV', '', '', '', '9,8,16,4,12', '2018-04-23', '4', 'customer@gmail.com', 'fdsa', 'fdsa', '32423', 'dfas', 22, '', 0, 0, 0, 0, 'paypal', 'pending', '', 0, 22, 'USD', '2018-04-19'),
(107, 'YdgACpvb1K7noEnCNKDzCPLoPnqA7GQxr3hucHS1', '', '', '', '9,8,16,3,4', '2018-04-23', '8', 'customer@gmail.com', 'dfa', '3dfsa', '32423', 'fdsafdsa', 22, '', 130, 149.5, 6.5, 13, 'paypal', 'paid', '', 2, 22, 'USD', '2018-04-19'),
(108, 'xlAPhWSOUlNUxRwwcASOSq1S7JYJtY10aC8frkn3', '', '', '', '14,8,3,9', '2018-04-28', '20', 'c.saravanan@hotmail.com', 'test', 'fdsa', '32423', 'fdsafdsaf', 29, '', 26, 30.42, 1.82, 2.6, 'paypal', 'refund', 'cancelled by vendor', 0, 41, 'USD', '2018-04-20'),
(109, 'xlAPhWSOUlNUxRwwcASOSq1S7JYJtY10aC8frkn3', '', '', '', '12,13', '2018-04-27', '9', 'c.saravanan@hotmail.com', 'dfsa', 'dfsa', '324', 'dfsa', 29, '', 8, 8.8, 0, 0.8, 'wallet', 'refund', 'cancelled by customer', 0, 23, 'USD', '2018-04-20'),
(110, 'xlAPhWSOUlNUxRwwcASOSq1S7JYJtY10aC8frkn3', 'tok_1CIsfxA4i5sXvQrkBtxfnrgp', '', '', '21,3,9', '2018-04-26', '21', 'c.saravanan@hotmail.com', 'fdas', 'fdsa', '324', 'dfsa', 29, '', 24, 28.08, 1.68, 2.4, 'stripe', 'refund', 'cancelled by vendor', 0, 41, 'USD', '2018-04-20'),
(111, 'xlAPhWSOUlNUxRwwcASOSq1S7JYJtY10aC8frkn3', '', '', '', '8,9,10,12,13,14,17', '2018-04-21', '6', 'c.saravanan@hotmail.com', 'fdsa', 'fdsa', '324', 'fdsa', 29, '', 40, 44, 0, 4, 'wallet', 'paid', '', 0, 25, 'USD', '2018-04-20'),
(112, 'xlAPhWSOUlNUxRwwcASOSq1S7JYJtY10aC8frkn3', '', '019d4566979fdb354ab9', '', '3,4,8,9,10,11,13,14', '2018-04-24', '14', 'c.saravanan@hotmail.com', 'sdfa', 'fdsa', '32432', 'fdasfdsdfas', 29, '', 31, 34.1, 0, 3.1, 'payumoney', 'paid', '', 0, 24, 'USD', '2018-04-20'),
(113, 'rAgUcZn5YvmNSUm21d9CJdd88DoymmU2gQ12LeEH', '', '', '', '4,8,9,11', '2018-04-24', '13', 'alexxiazofia@gmail.com', 'fdasfdasfd', 'fdsafdsa', '32423', 'fdfdafdasd', 31, '', 13, 14.3, 0, 1.3, 'paypal', 'paid', '', 0, 24, 'USD', '2018-04-20'),
(114, '7lvC9JIYpN6yogHBYkX6NJp6XVOrVxwiMdxsCddH', '', '', '', '8', '2018-04-26', '10', 'buyer20@g.com', 'sss', 'sss', '2323', 'sss', 32, '', 20, 24, 2, 2, 'paypal', 'refund', 'cancelled by customer', 0, 42, 'USD', '2018-04-20'),
(115, '7lvC9JIYpN6yogHBYkX6NJp6XVOrVxwiMdxsCddH', '', '', '', '8', '2018-04-27', '13', 'buyer20@g.com', 'sdf', 'sdf', '2323', 'sdfsdf', 32, '', 20, 24, 2, 2, 'wallet', 'refund', 'cancelled by vendor', 0, 42, 'USD', '2018-04-20'),
(116, 'BpPtt01pd4fpeZdsTlaABJV41Ma1hYwdM1i4rgJq', '', '', '', '15', '2018-04-21', '3', 'buyer20@g.com', 'sdf', 'sdsd', '23', 'sdfsd', 32, '', 8, 8.8, 0, 0.8, 'paypal', 'pending', '', 0, 28, 'USD', '2018-04-20'),
(117, 'NnuNNUy5frS0bjFzopcy2KA6rqbIi1tQsOxDCAbn', '', '', '', '4,9,14', '1970-01-01', '17', 'fdsa@dfsa.com', 'fdsa', 'fdsa', '3232', 'dfsa', 37, '', 17, 18.7, 0, 1.7, 'paypal', 'paid', '', 0, 28, 'USD', '2018-04-20'),
(118, 'LSPMTMe1ONv2bT5kKJQmFFNpYNj7UcP1oYgcHmg2', '', '', '3T0167974G445962W', '21,3,4,9,12', '2018-04-27', '10', 'seller@seller.com', 'fdas', 'fdsafdsa', '32432', 'fdfdsafsd', 4, '', 179, 196.9, 0, 17.9, 'paypal', 'paid', '', 0, 23, 'USD', '2018-04-23'),
(119, 'LSPMTMe1ONv2bT5kKJQmFFNpYNj7UcP1oYgcHmg2', '', '', '7NV074118N648332R', '21,3,4,9,12', '2018-04-26', '7', 'seller@seller.com', 'f', 'fd', '43', 'df', 4, '', 179, 196.9, 0, 17.9, 'paypal', 'paid', '', 0, 23, 'USD', '2018-04-23'),
(120, 'lPq0EIHvuoXm321LfKP08pLLKdn2JS42SBLyIBKr', '', '', '', '3,9,12', '2018-08-23', '7', 'seller@seller.com', 'test', 'tes', '32423', 'dsafdsa', 4, '', 0, 0, 0, 0, 'paypal', 'pending', '', 0, 23, 'USD', '2018-08-17'),
(121, '2feFkNrwaBOJEFnSuOHE125i3NymL8gQNNkttDjz', '', '', '41454417DJ670682B', '8,16,4,12', '2018-08-22', '6', 'customer1@customer.com', 'test', 'fdsa', '324', 'dfsa', 17, '', 44, 50.6, 2.2, 4.4, 'paypal', 'refund', 'cancelled by customer', 0, 22, 'USD', '2018-08-17'),
(122, '2feFkNrwaBOJEFnSuOHE125i3NymL8gQNNkttDjz', '', '', '8MK118861L773272X', '16,4,12', '2018-08-22', '10', 'customer1@customer.com', 'dsa', 'dfsa', '324', 'fdsa', 17, '', 21, 24.15, 1.05, 2.1, 'paypal', 'refund', 'cancelled by customer', 0, 22, 'USD', '2018-08-17'),
(123, '2feFkNrwaBOJEFnSuOHE125i3NymL8gQNNkttDjz', 'tok_1D02WnA4i5sXvQrkMJzSQlWY', '', '', '16,3,4,12', '2018-08-22', '15', 'customer1@customer.com', 'dfsa', '324', '324', 'fdsa', 17, '', 23, 26.45, 1.15, 2.3, 'stripe', 'paid', '', 2, 22, 'USD', '2018-08-17'),
(124, '2feFkNrwaBOJEFnSuOHE125i3NymL8gQNNkttDjz', '', '', '', '8,16,3,12', '2018-08-20', '16', 'customer1@customer.com', 'dsa', 'fdsafdsa', '32432', 'dffsda', 17, '', 43, 49.45, 2.15, 4.3, 'payumoney', 'failed', '', 0, 22, 'USD', '2018-08-17'),
(125, '2feFkNrwaBOJEFnSuOHE125i3NymL8gQNNkttDjz', '', '', '', '16,4,12', '2018-08-22', '5', 'customer1@customer.com', 'dsa', 'dfsa', '324', 'fdsa', 17, '', 21, 24.15, 1.05, 2.1, 'wallet', 'paid', '', 2, 22, 'USD', '2018-08-17'),
(126, 'rRMEDLUH4yGQ4uVTdzfVX7vMxXKLzipY2PVsF5eq', '', '', '0YB88953WM939541A', '16,3,4,12', '2018-08-22', '6', 'customer1@customer.com', 'dfsa', 'fdas', '324', 'dfsa', 17, '', 23, 26.45, 1.15, 2.3, 'paypal', 'paid', '', 2, 22, 'USD', '2018-08-17'),
(127, 'PEyFEwOtcFw37QPfThjTz2vGC8BqRH8YG0sOQAv6', '', '', '5KB50193YT117214K', '16,4,12', '2018-08-22', '5', 'customer1@customer.com', 'sd', 'sda', '213', 'SDADSA', 17, '', 21, 24.15, 1.05, 2.1, 'paypal', 'paid', '', 2, 22, 'USD', '2018-08-18'),
(128, 'PEyFEwOtcFw37QPfThjTz2vGC8BqRH8YG0sOQAv6', 'tok_1D0NO3A4i5sXvQrklu9pQ5Ar', '', '', '4,11,12,13', '2018-08-20', '6', 'customer1@customer.com', 'DFAS', 'DFSA', '324', 'DSA', 17, '', 16, 18.4, 0.8, 1.6, 'stripe', 'refund', 'cancelled by admin', 2, 22, 'USD', '2018-08-18'),
(129, 'PEyFEwOtcFw37QPfThjTz2vGC8BqRH8YG0sOQAv6', '', '', '0PG453630C911012J', '16,4,12', '2018-08-20', '6', 'customer1@customer.com', 'dfsa', 'dfsa', '32432', 'dfsadfsa', 17, '', 21, 24.15, 1.05, 2.1, 'paypal', 'paid', '', 2, 22, 'USD', '2018-08-18'),
(130, 'YZUg9LkD4VjbrIszm4uXeAlOQWGRt3a2BGT7gHtM', '', '', '1E304122YX7568220', '16,3,12', '2018-08-25', '12', 'customer1@customer.com', 'fdas', 'fdas', '324', 'fdsa', 17, '', 20, 23, 1, 2, 'paypal', 'refund', 'cancelled by vendor', 0, 22, 'USD', '2018-08-20'),
(131, 'YZUg9LkD4VjbrIszm4uXeAlOQWGRt3a2BGT7gHtM', '', '', '8KY14015SC634142H', '3,4,11', '2018-08-25', '14', 'customer1@customer.com', 'dsa', 'fdsa', '324', 'dsa', 17, '', 11, 12.65, 0.55, 1.1, 'paypal', 'refund', 'cancelled by customer', 0, 22, 'USD', '2018-08-20'),
(132, 'YZUg9LkD4VjbrIszm4uXeAlOQWGRt3a2BGT7gHtM', '', '', '20753385GV186003W', '3,4,13', '2018-08-22', '3', 'customer1@customer.com', 'fgds', 'fsd', '435', 'fgdsfdsgfds', 17, '', 6, 6.9, 0.3, 0.6, 'paypal', 'paid', '', 2, 22, 'USD', '2018-08-20'),
(133, 'YZUg9LkD4VjbrIszm4uXeAlOQWGRt3a2BGT7gHtM', '', '', '36K11315B0197025A', '8,16,4,12', '2018-08-22', '7', 'customer1@customer.com', 'dfsa', 'dfsa', '324', 'fdsafdsa', 17, '', 44, 50.6, 2.2, 4.4, 'paypal', 'paid', '', 2, 22, 'USD', '2018-08-20'),
(134, 'YZUg9LkD4VjbrIszm4uXeAlOQWGRt3a2BGT7gHtM', 'tok_1D17yDA4i5sXvQrkhNgLDYX1', '', '', '3,4,10,13', '2018-08-22', '10', 'customer1@customer.com', 'fds', 'fgds', '435', 'fgds', 17, '', 10, 11.5, 0.5, 1, 'stripe', 'paid', '', 0, 22, 'USD', '2018-08-20'),
(135, 'YZUg9LkD4VjbrIszm4uXeAlOQWGRt3a2BGT7gHtM', 'tok_1D188RA4i5sXvQrklI7QqAMK', '', '', '16,3,13', '2018-08-25', '16', 'customer1@customer.com', 'sdfsa', 'fdsa', '324', 'dfsa', 17, '', 15, 17.25, 0.75, 1.5, 'stripe', 'paid', '', 2, 22, 'USD', '2018-08-20'),
(136, 'YZUg9LkD4VjbrIszm4uXeAlOQWGRt3a2BGT7gHtM', '', '', '', '10,12', '2018-08-22', '9', 'customer1@customer.com', 'dsfa', 'fdsa', '3242', 'dfsa', 17, '', 10, 11.5, 0.5, 1, 'wallet', 'refund', 'cancelled by admin', 2, 22, 'USD', '2018-08-20'),
(137, 'Bip60LlM0ZFbITOYTSxcUum7ajtueUKwQCnponbJ', '', '', '', '14', '2019-01-29', '10', 'seller@seller.com', '1690 William Kennerty Dr', 'Charleston', '8506', '', 4, '', 7, 7.7, 0, 0.7, 'wallet', 'paid', '', 0, 27, 'USD', '2019-01-28');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `cat_order` int(100) NOT NULL,
  `meta_desc` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `featured` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`, `cat_order`, `meta_desc`, `meta_keywords`, `featured`) VALUES
(3, 'Blockchain Services', '1515493754.png', 2, 'Blockchain Services', 'Blockchain Services', 'yes'),
(4, 'Consultancy', '1515493965.png', 6, 'Consultancy', 'Consultancy', 'yes'),
(5, 'Graphics & Design', '1515493788.png', 10, 'Graphics & Design', 'Graphics & Design', 'yes'),
(6, 'Writing & Translation', '1515494001.png', 5, 'Writing & Translation', 'Writing & Translation', 'yes'),
(7, 'Digital Marketing', '1515493827.png', 8, 'Digital Marketing', 'Digital Marketing', 'yes'),
(8, 'Video & Animation', '1515494029.png', 7, 'Video & Animation', 'Video & Animation', 'yes'),
(9, 'Music & Audio', '1515493869.png', 2, 'Music & Audio', 'Music & Audio', 'yes'),
(10, 'Business', '1515494063.png', 6, 'Business', 'Business', 'yes'),
(11, 'Programming & Tech', '1515493904.png', 3, 'Programming & Tech', 'Programming & Tech', 'yes'),
(12, 'Fun & Style', '1515494087.png', 9, 'Fun & Style', 'Fun & Style', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
  `id` int(11) NOT NULL,
  `gid` int(200) NOT NULL,
  `order_id` int(200) NOT NULL,
  `msg_type` varchar(50) NOT NULL,
  `buyer_id` int(200) NOT NULL,
  `seller_id` int(200) NOT NULL,
  `message` text NOT NULL,
  `submit_date` datetime NOT NULL,
  `file` varchar(1000) NOT NULL,
  `got_problem` varchar(200) NOT NULL,
  `complete_work` varchar(50) NOT NULL,
  `submission` varchar(50) NOT NULL,
  `problem_reason` varchar(200) NOT NULL,
  `mutual_cancel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat_message`
--

INSERT INTO `chat_message` (`id`, `gid`, `order_id`, `msg_type`, `buyer_id`, `seller_id`, `message`, `submit_date`, `file`, `got_problem`, `complete_work`, `submission`, `problem_reason`, `mutual_cancel`) VALUES
(202, 3, 11, 'buyer_msg', 4, 17, 'dsffa', '2018-08-30 10:42:15', '', 'no', '', '', '', ''),
(203, 3, 11, 'buyer_msg', 4, 17, 'test', '2018-08-30 11:02:05', '1535626925.jpeg', 'no', '', '', '', ''),
(204, 3, 11, 'buyer_msg', 4, 17, 'yes problem', '2018-08-30 11:02:35', '1535626955.jpeg', 'yes', '', '', '', ''),
(205, 3, 11, 'buyer_msg', 4, 17, 'please cancel order', '2018-08-30 11:08:56', '', 'yes', '', '', 'Mutual_Cancellation', 'no'),
(206, 3, 11, 'buyer_msg', 4, 17, 'why cancel? i need amount', '2018-08-30 11:37:58', '', 'yes', '', '', 'Mutual_Cancellation', 'yes'),
(207, 4, 12, 'seller_msg', 17, 4, 'i not working your job', '2018-08-30 12:17:18', '', 'no', 'no', 'no', '', ''),
(208, 4, 12, 'buyer_msg', 17, 4, 'why?', '2018-08-30 12:17:45', '', 'no', '', '', '', ''),
(209, 4, 12, 'seller_msg', 17, 4, 'i need cancel?', '2018-08-30 12:18:11', '1535631491.zip', 'no', 'no', 'no', '', ''),
(210, 4, 12, 'seller_msg', 17, 4, 'must cancel', '2018-08-30 12:18:55', '', 'yes', 'no', 'no', 'Mutual_Cancellation', 'yes'),
(211, 5, 13, 'buyer_msg', 4, 17, 'test', '2018-08-30 12:34:45', '', 'no', '', '', '', ''),
(212, 5, 13, 'seller_msg', 4, 17, 'test', '2018-08-30 12:41:47', '', 'yes', 'no', 'no', 'Force_Cancellation', 'yes'),
(213, 6, 14, 'seller_msg', 4, 17, 'job completed', '2018-08-30 12:55:38', '', 'no', 'yes', '', '', ''),
(214, 6, 14, 'buyer_msg', 4, 17, 'not done', '2018-08-30 12:57:18', '', 'yes', '', '', '', ''),
(215, 6, 14, 'buyer_msg', 4, 17, 'not done', '2018-08-30 12:57:49', '', 'yes', '', '', 'Mutual_Cancellation', 'no'),
(216, 6, 14, 'seller_msg', 4, 17, 'done', '2018-08-30 12:58:21', '', 'no', 'yes', '', '', ''),
(217, 7, 15, 'seller_msg', 4, 22, 'complete the works', '2018-08-31 06:35:17', '', 'no', 'yes', '', '', ''),
(218, 8, 16, 'seller_msg', 4, 17, 'done', '2018-08-31 12:48:45', '', 'yes', 'no', '', 'Mutual_Cancellation', 'no'),
(219, 8, 16, 'buyer_msg', 4, 17, 'not done', '2018-08-31 12:50:15', '', 'yes', '', '', 'Get_Help', ''),
(220, 8, 16, 'seller_msg', 4, 17, 'sd', '2018-08-31 12:50:48', '', 'no', 'yes', '', '', ''),
(221, 8, 16, 'buyer_msg', 4, 17, 'fds', '2018-08-31 12:51:22', '', 'no', '', '', '', ''),
(222, 8, 16, 'seller_msg', 4, 17, 'done', '2018-08-31 12:51:45', '', 'no', 'yes', '', '', ''),
(223, 11, 27, 'buyer_msg', 22, 22, 'hia', '2018-09-03 09:25:09', '', 'no', '', '', '', ''),
(224, 11, 27, 'buyer_msg', 17, 22, 'test', '2018-09-03 09:32:41', '', 'no', '', '', '', ''),
(225, 12, 28, 'buyer_msg', 4, 17, 'hi', '2018-09-03 10:10:57', '', 'no', '', '', '', ''),
(226, 12, 28, 'seller_msg', 4, 17, 'well', '2018-09-03 10:11:23', '', 'no', 'yes', 'yes', '', ''),
(227, 13, 29, 'buyer_msg', 4, 17, 'CANCEL', '2018-09-03 10:26:40', '', 'yes', '', '', 'Mutual_Cancellation', 'yes'),
(228, 14, 30, 'buyer_msg', 4, 22, 'test', '2018-09-03 10:38:25', '', 'no', '', '', '', ''),
(229, 14, 30, 'seller_msg', 4, 22, 'we', '2018-09-03 10:39:44', '', 'yes', 'no', 'no', 'Mutual_Cancellation', 'yes'),
(230, 15, 31, 'seller_msg', 4, 17, 'dd', '2018-09-03 11:09:12', '', 'yes', 'no', 'no', 'Force_Cancellation', 'yes'),
(231, 16, 32, 'seller_msg', 4, 17, 'done', '2018-09-03 11:30:07', '', 'no', 'yes', '', '', ''),
(232, 22, 85, 'buyer_msg', 48, 49, 'hi', '2018-09-06 06:43:14', '', 'no', '', '', '', ''),
(233, 22, 85, 'seller_msg', 48, 49, 'hello', '2018-09-06 06:58:06', '', 'no', 'yes', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `contact_vendor`
--

CREATE TABLE `contact_vendor` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `vendor_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_vendor`
--

INSERT INTO `contact_vendor` (`id`, `name`, `phone_no`, `email`, `message`, `vendor_id`) VALUES
(10, 'ss', '3223', 'dd@dd.com', 'dfsa', 21),
(11, 'demoworks', '8767867676', 'demoworks@gmail.com', 'yy', 25),
(12, 'sample_customer', '54545454', 'c.saravanan@hotmail.com', 'hai', 40),
(13, 'sample_customer', '54545454', 'c.saravanan@hotmail.com', 'fdafdsfsdafdsa', 41);

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL,
  `gig_id` varchar(200) NOT NULL,
  `sender` int(200) NOT NULL,
  `receiver` int(200) NOT NULL,
  `message` text NOT NULL,
  `read_write_status` int(100) NOT NULL,
  `date_submitted` datetime NOT NULL,
  `file` varchar(200) NOT NULL,
  `report` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`id`, `gig_id`, `sender`, `receiver`, `message`, `read_write_status`, `date_submitted`, `file`, `report`) VALUES
(6, '44', 29, 30, 'sample worked file', 1, '2018-01-05 10:30:10', '1515148210.docx', 0),
(7, '40', 29, 30, '', 0, '0000-00-00 00:00:00', '', 0),
(8, '44', 30, 29, 'hello sarav', 0, '2018-01-05 12:06:52', '', 0),
(9, '40', 30, 29, 'this hotel very nice and see this one', 0, '2018-01-05 12:08:20', '1515154100.jpg', 0),
(10, '40', 29, 30, 'very thanks', 1, '2018-01-05 12:24:25', '', 0),
(11, '40', 30, 29, 'fine', 0, '2018-01-05 12:25:40', '1515155140.png', 0),
(12, '40', 30, 29, 'check above message', 0, '2018-01-05 12:30:01', '', 0),
(13, '40', 30, 29, 'tess', 0, '2018-01-05 12:30:56', '', 0),
(14, '40', 30, 29, 'wee', 0, '2018-01-05 12:31:33', '', 0),
(16, '44', 29, 30, 'hi', 0, '2018-01-05 12:48:53', '', 0),
(17, '44', 30, 29, 'hi', 0, '2018-01-05 12:50:58', '', 0),
(18, '44', 29, 30, 'sample', 0, '2018-01-09 09:17:55', '', 0),
(19, '44', 29, 30, 'welcome friend', 1, '2018-01-09 09:18:20', '1515489500.JPG', 0),
(20, '44', 29, 30, 'sample message', 1, '2018-01-09 09:22:27', '', 0),
(21, '44', 29, 30, 'Hi,\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum\r\n\r\n\r\nThanks,\r\n\r\nc.saravanan', 0, '2018-01-09 09:51:25', '1515491485.pdf', 0),
(22, '43', 29, 30, 'New mobiles it\'s good', 0, '2018-01-09 09:53:04', '1515491584.jpg', 0),
(23, '44', 30, 29, 'Goodworks', 0, '2018-01-09 09:53:57', '', 0),
(24, '44', 30, 29, 'Test', 0, '2018-01-09 09:56:36', '', 0),
(25, '44', 30, 29, 'jj', 0, '2018-01-09 10:08:04', '', 0),
(26, '42', 30, 29, 'hi', 0, '2018-01-09 10:08:34', '', 0),
(27, '44', 29, 30, 'super', 0, '2018-01-09 10:15:04', '', 0),
(28, '44', 29, 30, 'weldone', 0, '2018-01-09 10:24:02', '', 0),
(30, '40', 1, 29, 'test', 0, '2018-01-09 12:40:33', '1515501633.png', 0),
(31, '40', 29, 1, 'weweww', 0, '2018-01-09 12:41:27', '', 0),
(32, '52', 29, 31, 'hi', 0, '2018-01-25 10:10:11', '', 0),
(33, '52', 31, 29, 'best message', 1, '2018-01-25 10:11:05', '', 0),
(34, '57', 29, 30, 'hi', 1, '2018-02-08 09:20:22', '', 0),
(36, '0', 29, 30, 'ssad', 0, '2018-02-08 09:28:47', '', 0),
(37, '0', 29, 30, 'hi', 0, '2018-02-08 09:31:50', '', 0),
(38, '0', 29, 31, 'hello', 0, '2018-02-08 09:49:00', '', 0),
(39, '0', 31, 29, 'welcome', 1, '2018-02-08 09:49:42', '', 0),
(40, '0', 31, 30, 'hello bala', 0, '2018-02-08 09:50:49', '', 0),
(41, '54', 1, 29, 'hi', 1, '2018-02-10 05:10:03', '', 0),
(42, '0', 1, 29, 'hi', 1, '2018-02-10 05:39:26', '', 0),
(43, '0', 1, 29, 'sample works send me', 0, '2018-02-10 05:40:20', '1518241220.jpeg', 0),
(44, '81', 37, 38, 'bad', 1, '2018-02-23 12:48:27', '', 0),
(45, '81', 38, 37, 'your work is waste', 1, '2018-02-23 12:49:44', '', 0),
(46, '0', 38, 37, 'very bad', 1, '2018-02-23 12:50:18', '', 0),
(47, '130', 37, 30, 'Hi', 1, '2018-05-11 12:59:11', '', 0),
(48, '130', 37, 30, 'hello', 1, '2018-05-11 13:00:53', '', 0),
(49, '130', 30, 37, 'jhjh', 1, '2018-05-11 13:01:55', '', 0),
(50, '130', 34, 30, 'hi', 1, '2018-05-12 05:45:28', '', 0),
(51, '130', 34, 30, 'hello', 1, '2018-05-12 05:45:48', '', 0),
(52, '134', 34, 37, 'test', 1, '2018-05-12 07:20:21', '', 0),
(53, '134', 37, 34, 'hello', 1, '2018-05-12 07:21:19', '', 0),
(54, '140', 31, 37, 'sdfsdf', 1, '2018-06-06 11:59:23', '', 0),
(55, '3', 17, 4, 'hai', 1, '2018-08-30 06:57:25', '', 0),
(56, '3', 17, 4, 'test', 1, '2018-08-30 07:08:00', '1535612880.jpeg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dispute`
--

CREATE TABLE `dispute` (
  `dispute_id` int(11) NOT NULL,
  `booking_id` int(200) NOT NULL,
  `booking_date` date NOT NULL,
  `dispute_date` date NOT NULL,
  `customer_name` varchar(200) NOT NULL,
  `customer_id` int(100) NOT NULL,
  `vendor_name` varchar(200) NOT NULL,
  `vendor_id` int(100) NOT NULL,
  `payment` float NOT NULL,
  `subject` varchar(1000) NOT NULL,
  `message` text NOT NULL,
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dispute`
--

INSERT INTO `dispute` (`dispute_id`, `booking_id`, `booking_date`, `dispute_date`, `customer_name`, `customer_id`, `vendor_name`, `vendor_id`, `payment`, `subject`, `message`, `status`) VALUES
(7, 128, '2018-08-20', '2018-08-18', 'customer1', 17, 'seller', 4, 16.8, 'please refund request', 'please refund my amount', 'payment refunded to customer'),
(8, 129, '2018-08-20', '2018-08-18', 'customer1', 17, 'seller', 4, 22.05, 'i need the payment', 'hello please help me i need the payment he is fraud', 'payment released to vendor'),
(10, 136, '2018-08-22', '2018-08-20', 'customer1', 17, 'seller', 4, 10.5, 'test', 'fdsa', 'payment refunded to customer');

-- --------------------------------------------------------

--
-- Table structure for table `gigs`
--

CREATE TABLE `gigs` (
  `gid` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `user_id` int(100) NOT NULL,
  `giger_id` int(100) NOT NULL,
  `subject` text NOT NULL,
  `request_slug` varchar(200) NOT NULL,
  `featured_image` varchar(200) NOT NULL,
  `request_skills` varchar(500) NOT NULL,
  `price` int(11) NOT NULL,
  `category` int(100) NOT NULL,
  `subcategory` int(200) NOT NULL,
  `category_type` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `instruction` text NOT NULL,
  `budget_type` varchar(200) NOT NULL,
  `submit_date` date NOT NULL,
  `featured` int(50) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `feature_price` int(11) NOT NULL,
  `feature_start_date` date NOT NULL,
  `feature_end_date` date NOT NULL,
  `reference_id` int(255) NOT NULL,
  `payment_date` varchar(200) NOT NULL,
  `additional_info` text NOT NULL,
  `tags` varchar(500) NOT NULL,
  `complete_days` int(50) NOT NULL,
  `preferred_location` text NOT NULL,
  `video_url` varchar(200) NOT NULL,
  `gig_type` varchar(50) NOT NULL,
  `job_type` varchar(50) NOT NULL,
  `maximum_qty` int(50) NOT NULL,
  `extra_text1` varchar(200) NOT NULL,
  `extra_price1` int(100) NOT NULL,
  `extra_text2` varchar(200) NOT NULL,
  `extra_price2` int(100) NOT NULL,
  `extra_text3` varchar(200) NOT NULL,
  `extra_price3` int(100) NOT NULL,
  `fixed_price` varchar(200) NOT NULL,
  `hour_price` varchar(200) NOT NULL,
  `minimum_budget` int(200) NOT NULL,
  `maximum_budget` int(200) NOT NULL,
  `fixed_minimum` int(100) NOT NULL,
  `fixed_maximum` int(100) NOT NULL,
  `hour_minimum` int(100) NOT NULL,
  `hour_maximum` int(100) NOT NULL,
  `local_ship_price` int(100) NOT NULL,
  `local_ship_place` varchar(200) NOT NULL,
  `world_ship_price` int(100) NOT NULL,
  `view_count` int(255) NOT NULL,
  `delete_status` varchar(50) NOT NULL,
  `request_status` int(50) NOT NULL,
  `bid_status` int(50) NOT NULL,
  `sent_mail` int(50) NOT NULL,
  `status` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gigs`
--

INSERT INTO `gigs` (`gid`, `token`, `user_id`, `giger_id`, `subject`, `request_slug`, `featured_image`, `request_skills`, `price`, `category`, `subcategory`, `category_type`, `description`, `instruction`, `budget_type`, `submit_date`, `featured`, `payment_type`, `feature_price`, `feature_start_date`, `feature_end_date`, `reference_id`, `payment_date`, `additional_info`, `tags`, `complete_days`, `preferred_location`, `video_url`, `gig_type`, `job_type`, `maximum_qty`, `extra_text1`, `extra_price1`, `extra_text2`, `extra_price2`, `extra_text3`, `extra_price3`, `fixed_price`, `hour_price`, `minimum_budget`, `maximum_budget`, `fixed_minimum`, `fixed_maximum`, `hour_minimum`, `hour_maximum`, `local_ship_price`, `local_ship_place`, `world_ship_price`, `view_count`, `delete_status`, `request_status`, `bid_status`, `sent_mail`, `status`) VALUES
(1, '5b8522917e788', 4, 0, 'dsaf', 'dsaf', '', '10,7', 0, 10, 0, 'cat', 'fdsafdsafdsfdsa', '', 'fixed', '2018-08-28', 0, '', 0, '0000-00-00', '0000-00-00', 0, '', '', '', 0, '', '', '', 'request', 0, '', 0, '', 0, '', 0, '10 - 30 USD', '2 - 8 USD', 0, 0, 10, 30, 2, 8, 0, '', 0, 0, 'deleted', 0, 0, 1, 0),
(2, '5b852cec6be91', 4, 0, 'sample', 'sample', '1535454444.jpeg', '8,7,13', 0, 10, 8, 'cat', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', '', 'fixed', '2018-08-28', 1, 'paypal', 15, '2018-08-29', '2018-09-18', 27760, '2018-08-29', '', '', 5, 'Chennai, Tamil Nadu, India', '', '', 'request', 0, '', 0, '', 0, '', 0, '30 - 250 USD', '2 - 8 USD', 0, 0, 30, 250, 2, 8, 0, '', 0, 0, 'deleted', 0, 0, 1, 0),
(3, '5b8646202236d', 4, 17, 'wordpress customization works', 'wordpress-customization-works', '1535526432.jpg', '10,23,14', 0, 10, 8, 'cat', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', '', 'fixed', '2018-08-29', 1, 'stripe', 15, '0000-00-00', '0000-00-00', 25812, '2018-09-04', '', '', 10, 'Singapore, South Africa', '', '', 'request', 0, '', 0, '', 0, '', 0, '750 - 1500 USD', '2 - 8 USD', 0, 0, 750, 1500, 2, 8, 0, '', 0, 0, '', 2, 0, 1, 1),
(4, '5b87de0646f16', 17, 4, 'Mobile App Developed', 'mobile-app-developed', '1535630854.jpeg', '5,3,4', 0, 5, 6, 'cat', 'lorem ipsum lorem ipsum lorem ipsum', '', 'fixed', '2018-08-30', 1, 'paypal', 15, '2018-08-30', '2018-09-19', 82793, '2018-08-30', '', '', 5, 'Kuala Lumpur, Federal Territory of Kuala Lumpur, Malaysia', '', '', 'request', 0, '', 0, '', 0, '', 0, '250 - 750 USD', '2 - 8 USD', 0, 0, 250, 750, 2, 8, 0, '', 0, 0, '', 2, 0, 1, 1),
(5, '5b87e35639ff0', 4, 17, 'sample job', 'sample-job', '1535632214.jpeg', '11,8,7', 0, 10, 8, 'cat', 'test test test test', '', 'fixed', '2018-08-30', 1, 'payumoney', 15, '0000-00-00', '0000-00-00', 20252, '2018-09-04', '', '', 6, 'Edmonton, AB, Canada', '', '', 'request', 0, '', 0, '', 0, '', 0, '5000 - 10000 USD', '2 - 8 USD', 0, 0, 5000, 10000, 2, 8, 0, '', 0, 0, '', 2, 0, 1, 1),
(6, '5b87e7aba704f', 4, 17, 'test', 'test', '1535633323.jpeg', '7,9,5', 0, 10, 8, 'cat', 'test', '', 'fixed', '2018-08-30', 1, 'payumoney', 15, '0000-00-00', '0000-00-00', 50042, '2018-09-04', '', '', 2, 'Mumbai, Maharashtra, India', '', '', 'request', 0, '', 0, '', 0, '', 0, '250 - 750 USD', '2 - 8 USD', 0, 0, 250, 750, 2, 8, 0, '', 0, 0, '', 2, 1, 1, 1),
(7, '5b88d9018c9d4', 4, 22, 'css works', 'css-works', '1535695105.jpeg', '10,7,9', 0, 4, 3, 'cat', 'lorem ipsum lorem ipsum', '', 'fixed', '2018-08-31', 1, '', 0, '0000-00-00', '0000-00-00', 37020, '', '', '', 6, 'Mumbai, Maharashtra, India', '', '', 'request', 0, '', 0, '', 0, '', 0, '250 - 750 USD', '2 - 8 USD', 0, 0, 250, 750, 2, 8, 0, '', 0, 0, '', 2, 1, 1, 1),
(8, '5b8937d3c1cb0', 4, 17, 'Opencart Design', 'opencart-design', '1535719380.jpg', '7,5,16', 0, 4, 5, 'cat', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', '', 'fixed', '2018-08-31', 1, 'payumoney', 15, '0000-00-00', '0000-00-00', 24004, '2018-09-04', '', '', 12, 'Frankfurt am Main, Germany', '', '', 'request', 0, '', 0, '', 0, '', 0, '3000 - 5000 USD', '2 - 8 USD', 0, 0, 3000, 5000, 2, 8, 0, '', 0, 0, '', 2, 1, 1, 1),
(9, '5b893bc6d4d5d', 17, 22, 'html template', 'html-template', '1535720390.jpg', '8,13,5', 0, 4, 5, 'cat', 'test', '', 'fixed', '2018-08-31', 1, '', 0, '0000-00-00', '0000-00-00', 11261, '', '', '', 4, 'Edmonton, AB, Canada', '', '', 'request', 0, '', 0, '', 0, '', 0, '250 - 750 USD', '2 - 8 USD', 0, 0, 250, 750, 2, 8, 0, '', 0, 0, '', 0, 0, 0, 1),
(10, '5b8ce2b12b169', 22, 17, 'test', 'test', '', '11,7,9', 0, 10, 8, 'cat', 'test', '', 'fixed', '2018-09-03', 1, 'paypal', 15, '2018-09-04', '2018-09-24', 68809, '2018-09-04', '', '', 5, 'Dubai - United Arab Emirates', '', '', 'request', 0, '', 0, '', 0, '', 0, '250 - 750 USD', '2 - 8 USD', 0, 0, 250, 750, 2, 8, 0, '', 0, 0, '', 0, 0, 0, 1),
(11, '5b8cfd2099eb3', 22, 17, 'WELCOME', 'welcome', '', '11,7,9', 0, 10, 8, 'cat', 'TEST', '', 'fixed', '2018-09-03', 1, 'paypal', 15, '2018-09-04', '2018-09-14', 80847, '2018-09-04', '', '', 20, 'West Hollywood, CA, USA', '', '', 'request', 0, '', 0, '', 0, '', 0, '20000 - 50000 USD', '2 - 8 USD', 0, 0, 20000, 50000, 2, 8, 0, '', 0, 0, '', 2, 0, 1, 1),
(12, '5b8d0149bf861', 4, 17, 'seller post', 'seller-post', '', '11,10,7', 0, 3, 2, 'cat', 'est', '', 'fixed', '2018-09-03', 1, 'stripe', 15, '0000-00-00', '0000-00-00', 6787, '2018-09-04', '', '', 3, 'Singapore', '', '', 'request', 0, '', 0, '', 0, '', 0, '250 - 750 USD', '2 - 8 USD', 0, 0, 250, 750, 2, 8, 0, '', 0, 0, '', 2, 0, 1, 1),
(13, '5b8d0ab5907e3', 4, 17, 'DEMO', 'demo', '', '10,8,7', 0, 10, 8, 'cat', 'DMEO', '', 'fixed', '2018-09-03', 1, 'paypal', 15, '2018-09-04', '2018-09-14', 75333, '2018-09-04', '', '', 3, 'São Paulo, State of São Paulo, Brazil', '', '', 'request', 0, '', 0, '', 0, '', 0, '250 - 750 USD', '2 - 8 USD', 0, 0, 250, 750, 2, 8, 0, '', 0, 0, '', 2, 0, 1, 1),
(14, '5b8d0e600c3af', 4, 22, 'n1', 'n1', '', '10,7,13', 0, 4, 4, 'cat', 'fdas', '', 'fixed', '2018-09-03', 1, '', 0, '0000-00-00', '0000-00-00', 21269, '', '', '', 4, 'Dubai - United Arab Emirates', '', '', 'request', 0, '', 0, '', 0, '', 0, '250 - 750 USD', '2 - 8 USD', 0, 0, 250, 750, 2, 8, 0, '', 0, 0, '', 2, 0, 1, 1),
(15, '5b8d13b47100a', 4, 17, 'n2', 'n2', '', '11,10,8', 0, 10, 8, 'cat', 'test', '', 'fixed', '2018-09-03', 1, 'stripe', 15, '0000-00-00', '0000-00-00', 90610, '2018-09-04', '', '', 30, 'Vienna, Austria', '', '', 'request', 0, '', 0, '', 0, '', 0, '10 - 30 USD', '2 - 8 USD', 0, 0, 10, 30, 2, 8, 0, '', 0, 0, '', 2, 0, 1, 1),
(16, '5b8d1a3286698', 4, 17, 'n3', 'n3', '', '10,8,7', 0, 10, 8, 'cat', 'test', '', 'fixed', '2018-09-03', 1, 'stripe', 15, '0000-00-00', '0000-00-00', 55160, '2018-09-04', '', '', 10, 'Washington, DC, USA', '', '', 'request', 0, '', 0, '', 0, '', 0, '30 - 250 USD', '2 - 8 USD', 0, 0, 30, 250, 2, 8, 0, '', 0, 0, '', 2, 1, 1, 1),
(17, '5b8d1fbb6374c', 4, 17, 'n4', 'n4', '', '12,10,8', 0, 10, 8, 'cat', 'fd', '', 'fixed', '2018-09-03', 1, 'stripe', 15, '0000-00-00', '0000-00-00', 58591, '2018-09-04', '', '', 3, 'São Paulo, State of São Paulo, Brazil', '', '', 'request', 0, '', 0, '', 0, '', 0, '10 - 30 USD', '2 - 8 USD', 0, 0, 10, 30, 2, 8, 0, '', 0, 0, '', 2, 0, 1, 1),
(18, '5b8f9a74ca311', 22, 17, 'best', 'best', '', '10,8,7', 0, 10, 8, 'cat', 'test', '', 'fixed', '2018-09-05', 1, 'paypal', 15, '2018-09-05', '2018-09-15', 906, '2018-09-05', '', '', 4, 'Mumbai, Maharashtra, India', '', '', 'request', 0, '', 0, '', 0, '', 0, '30 - 250 USD', '2 - 8 USD', 0, 0, 30, 250, 2, 8, 0, '', 0, 0, '', 2, 0, 1, 1),
(19, '5b8fa139dc2a8', 4, 17, 'wel', 'wel', '', '10,8,7,13', 0, 4, 4, 'cat', 'wel', '', 'fixed', '2018-09-05', 1, '', 0, '0000-00-00', '0000-00-00', 40855, '', '', '', 4, 'Madurai, Tamil Nadu, India', '', '', 'request', 0, '', 0, '', 0, '', 0, '30 - 250 USD', '2 - 8 USD', 0, 0, 30, 250, 2, 8, 0, '', 0, 0, '', 2, 0, 1, 1),
(20, '5b8fb375d6f5e', 4, 17, 'sample data', 'sample-data', '', '10,8,13', 0, 4, 5, 'cat', 'sample data', '', 'fixed', '2018-09-05', 0, '', 0, '0000-00-00', '0000-00-00', 0, '', '', '', 3, 'Mumbai, Maharashtra, India', '', '', 'request', 0, '', 0, '', 0, '', 0, '30 - 250 USD', '2 - 8 USD', 0, 0, 30, 250, 2, 8, 0, '', 0, 0, '', 2, 0, 1, 1),
(21, '5b8fb5e137df5', 4, 17, 'works', 'works', '', '8,7,13', 0, 10, 8, 'cat', 'test', '', 'fixed', '2018-09-05', 0, '', 0, '0000-00-00', '0000-00-00', 0, '', '', '', 3, 'Mumbai, Maharashtra, India', '', '', 'request', 0, '', 0, '', 0, '', 0, '30 - 250 USD', '2 - 8 USD', 0, 0, 30, 250, 2, 8, 0, '', 0, 0, '', 1, 0, 1, 1),
(22, '5b90c9d1dd24f', 48, 49, 'wordpress plugin creation', 'wordpress-plugin-creation', '1536215506.png', '10,8,7', 0, 3, 2, 'cat', 'test', '', 'fixed', '2018-09-06', 1, 'payumoney', 15, '0000-00-00', '0000-00-00', 36772, '2018-09-06', '', '', 5, 'Pune, Maharashtra, India', '', '', 'request', 0, '', 0, '', 0, '', 0, '250 - 750 USD', '2 - 8 USD', 0, 0, 250, 750, 2, 8, 0, '', 0, 0, '', 2, 1, 1, 1),
(23, '5b90d3e715721', 49, 0, 'one', 'one', '', '8,13,9', 0, 10, 8, 'cat', 'one', '', 'fixed', '2018-09-06', 1, 'paypal', 15, '2018-09-06', '2018-09-16', 7125, '2018-09-06', '', '', 2, 'Madurai, Tamil Nadu, India', '', '', 'request', 0, '', 0, '', 0, '', 0, '30 - 250 USD', '2 - 8 USD', 0, 0, 30, 250, 2, 8, 0, '', 0, 0, 'deleted', 0, 0, 1, 0),
(24, '5b90d47854d67', 49, 0, 'two', 'two', '', '11,10,8', 0, 10, 8, 'cat', 'test', '', 'fixed', '2018-09-06', 1, 'stripe', 15, '0000-00-00', '0000-00-00', 39953, '2018-09-06', '', '', 3, 'Singapore', '', '', 'request', 0, '', 0, '', 0, '', 0, '10 - 30 USD', '2 - 8 USD', 0, 0, 10, 30, 2, 8, 0, '', 0, 0, 'deleted', 0, 0, 1, 0),
(25, '5b90d4ff3ad97', 49, 0, 'wq', 'wq', '', '10,8,7', 0, 10, 8, 'cat', 'we', '', 'fixed', '2018-09-06', 1, '', 0, '0000-00-00', '0000-00-00', 48603, '', '', '', 5, 'New Delhi, Delhi, India', '', '', 'request', 0, '', 0, '', 0, '', 0, '30 - 250 USD', '2 - 8 USD', 0, 0, 30, 250, 2, 8, 0, '', 0, 0, 'deleted', 0, 0, 1, 0),
(26, '5b9382a44ac48', 4, 0, 'test', 'test', '', '11,10,8,7', 0, 3, 0, 'cat', 'sdfhdg', '', 'fixed', '2018-09-08', 0, '', 0, '0000-00-00', '0000-00-00', 0, '', '', '', 5, 'Chennai, Tamil Nadu, India', '', '', 'request', 0, '', 0, '', 0, '', 0, '10 - 30 USD', '2 - 8 USD', 0, 0, 10, 30, 2, 8, 0, '', 0, 0, '', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `gig_images`
--

CREATE TABLE `gig_images` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gig_images`
--

INSERT INTO `gig_images` (`id`, `token`, `image`) VALUES
(2, '5b0e6c066b2d1', '0916543.jpg'),
(3, '5b0e6c8c34bfa', '0919082.jpg'),
(4, '5b0e6d44bdbd8', '0922122.jpg'),
(5, '5b0e6db604bf9', '0924064.jpg'),
(9, '5b178eb928ffb', '123747How-Blockchain-Should-Be-Used-in-the-Financial-Services-Industry.jpg'),
(10, '5af925046b944', '124407shutterstock_436946344-1-878x600.jpg'),
(11, '5b0f893137364', '124910consultancy2_medium.jpg'),
(12, '5b18f0df6d37c', '125211100-cashback-upto-rs-1000-on-all-your-home-service-booking-1500874931.jpg'),
(13, '5b406218d642f', '0647529127.jpg'),
(14, '5b406bfad8900', '073002c700x420.jpg'),
(15, '5b586d348122e', '122940Y-FZS.jpg'),
(16, '5b59ac0acee5d', '111002feature-2.jpg'),
(17, '5b5ac29705cd7', '065831Y-FZS.jpg'),
(18, '5b5ac2ec23357', '065956feature-2.jpg'),
(19, '5b5ec0db5e56c', '074011hp_15-bs002ne_15.6-inch_laptop_silver_-_left_view.jpg'),
(20, '5b5ee4cb54ef9', '10133151WP44Kq4JL._SL1000_.jpg'),
(21, '5b602cc701ff1', '093255925049243s.jpg'),
(22, '5b6bdfdbe7990', '063156aHR0cHM6Ly93d3cubGFwdG9wbWFnLmNvbS9pbWFnZXMvdXBsb2Fkcy80ODA0L2cvczEzXzEuanBn.jpg'),
(23, '5b77db4351a5e', '083931koi-fish-pond-garden-design-ideas-2017-youtube.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `gig_order`
--

CREATE TABLE `gig_order` (
  `id` int(11) NOT NULL,
  `gid` int(200) NOT NULL,
  `gig_user_id` int(100) NOT NULL,
  `user_id` int(200) NOT NULL,
  `reference_id` int(200) NOT NULL,
  `token` varchar(500) NOT NULL,
  `paypal_token` varchar(1000) NOT NULL,
  `coupon_id` int(50) NOT NULL,
  `coupon_code` varchar(100) NOT NULL,
  `coupon_by` int(100) NOT NULL,
  `coupon_user` varchar(100) NOT NULL,
  `coupon_commission` float NOT NULL,
  `price` int(200) NOT NULL,
  `processing_fee` varchar(50) NOT NULL,
  `seller_price` float NOT NULL,
  `admin_price` float NOT NULL,
  `affiliate_price` float NOT NULL,
  `affiliate_id` int(100) NOT NULL,
  `amount_by` varchar(200) NOT NULL,
  `type` varchar(100) NOT NULL,
  `ex_text` varchar(200) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `additional_info` text NOT NULL,
  `payment_date` date NOT NULL,
  `awaiting` int(50) NOT NULL,
  `payment_level` int(50) NOT NULL,
  `withdraw` varchar(50) NOT NULL,
  `withdraw_token` varchar(255) NOT NULL,
  `upcoming_payment` int(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gig_order`
--

INSERT INTO `gig_order` (`id`, `gid`, `gig_user_id`, `user_id`, `reference_id`, `token`, `paypal_token`, `coupon_id`, `coupon_code`, `coupon_by`, `coupon_user`, `coupon_commission`, `price`, `processing_fee`, `seller_price`, `admin_price`, `affiliate_price`, `affiliate_id`, `amount_by`, `type`, `ex_text`, `payment_type`, `additional_info`, `payment_date`, `awaiting`, `payment_level`, `withdraw`, `withdraw_token`, `upcoming_payment`, `status`) VALUES
(11, 3, 17, 4, 34425, 'PMqbXKTA3dBzE0mKSpakQlB7xNDDiQqp7ke1Ty98', '0E4367275R064041H', 0, '', 0, '', 0, 45, '10', 31.5, 3.5, 0, 0, 'buyer', '0', '0', 'paypal', '', '2018-08-30', 0, 4, '', '', 1, 'completed'),
(12, 4, 4, 17, 94578, 'u1uyJkr0MvxfYpAjxg3YGpVoMmdW56VsJgJCdqDG', '2T0292379E628682R', 0, '', 0, '', 0, 115, '10', 94.5, 10.5, 0, 0, 'buyer', '0', '0', 'paypal', '', '2018-08-30', 0, 4, '', '', 1, 'completed'),
(13, 5, 17, 4, 58533, 'PMqbXKTA3dBzE0mKSpakQlB7xNDDiQqp7ke1Ty98', '6T796256VS3989934', 0, '', 0, '', 0, 209, '10', 179.1, 19.9, 0, 0, 'buyer', '0', '0', 'paypal', '', '2018-08-30', 0, 4, '', '', 1, 'completed'),
(14, 6, 17, 4, 27764, 'PMqbXKTA3dBzE0mKSpakQlB7xNDDiQqp7ke1Ty98', '9T92357468825494L', 0, '', 0, '', 0, 80, '10', 63, 7, 0, 0, '', '0', '0', 'paypal', '', '2018-08-30', 0, 2, '', '', 1, 'completed'),
(15, 7, 22, 4, 18721, 'xAfdD91b02yROUq2G41rFLnXf3flQRepgzksTa4a', '9GP51794JX1501429', 0, '', 0, '', 0, 110, '10', 90, 10, 0, 0, '', '0', '0', 'paypal', '', '2018-08-31', 0, 2, '', '', 1, 'completed'),
(16, 8, 17, 4, 8152, 'xAfdD91b02yROUq2G41rFLnXf3flQRepgzksTa4a', '2PH24031NA551934U', 0, '', 0, '', 0, 510, '10', 450, 50, 0, 0, '', '0', '0', 'paypal', '', '2018-08-31', 0, 2, '', '', 1, 'completed'),
(27, 11, 22, 17, 77342, '5b8cfd90c3794', '', 0, '', 0, '', 0, 26, '', 14.4, 1.6, 0, 0, '', '0', '0', 'buyer_balance', '', '2018-09-03', 0, 1, '', '', 1, 'completed'),
(28, 12, 17, 4, 37806, '5b8d086c0276a', '', 0, '', 0, '', 0, 160, '', 135, 15, 0, 0, '', '0', '0', 'buyer_balance', '', '2018-09-03', 0, 1, '', '', 1, 'completed'),
(29, 13, 17, 4, 99001, '5b8d0b3386864', '', 0, '', 0, '', 0, 34, '10', 21.6, 2.4, 0, 0, 'buyer', '0', '0', 'buyer_balance', '', '2018-09-03', 0, 4, '', '', 1, 'completed'),
(30, 14, 22, 4, 52612, '5b8d0ee647481', '', 0, '', 0, '', 0, 15, '10', 4.5, 0.5, 0, 0, 'buyer', '0', '0', 'buyer_balance', '', '2018-09-03', 0, 4, '', '', 1, 'completed'),
(31, 15, 17, 4, 6408, '5b8d149150401', '', 0, '', 0, '', 0, 35, '10', 22.5, 2.5, 0, 0, 'buyer', '0', '0', 'buyer_balance', '', '2018-09-03', 0, 4, '', '', 1, 'completed'),
(32, 16, 17, 4, 68729, '5b8d1b0c0d36b', '', 0, '', 0, '', 0, 40, '10', 27, 3, 0, 0, '', '0', '0', 'buyer_balance', '', '2018-09-03', 0, 2, '', '', 1, 'completed'),
(33, 17, 17, 4, 45475, '5b8d21a8c4b11', '', 0, '', 0, '', 0, 20, '10', 9, 1, 0, 0, '', '0', '0', 'buyer_balance', '', '2018-09-03', 0, 1, '', '', 1, 'completed'),
(34, 17, 17, 4, 43702, '5b8d24876e1ad', '', 0, '', 0, '', 0, 20, '10', 9, 1, 0, 0, '', '0', '0', 'buyer_balance', '', '2018-09-03', 0, 1, '', '', 1, 'completed'),
(35, 19, 17, 4, 41392, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 40, '10', 0, 0, 0, 0, '', '0', '0', 'paypal', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(36, 19, 17, 4, 92530, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 40, '10', 0, 0, 0, 0, '', '0', '0', 'stripe', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(37, 19, 17, 4, 59747, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 40, '10', 0, 0, 0, 0, '', '0', '0', 'stripe', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(38, 19, 17, 4, 3514, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 40, '10', 27, 3, 0, 0, '', '0', '0', 'stripe', '', '2018-09-05', 0, 1, '', '', 1, 'completed'),
(39, 19, 17, 4, 49048, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 40, '10', 27, 3, 0, 0, '', '0', '0', 'stripe', '', '2018-09-05', 0, 1, '', '', 1, 'completed'),
(40, 20, 17, 4, 40823, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 185, '10', 0, 0, 0, 0, '', '0', '0', 'stripe', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(41, 20, 17, 4, 4535, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 185, '10', 157.5, 17.5, 0, 0, '', '0', '0', 'stripe', '', '2018-09-05', 0, 1, '', '', 1, 'completed'),
(42, 21, 17, 4, 49432, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(43, 21, 17, 4, 51276, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(44, 21, 17, 4, 14964, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(45, 21, 17, 4, 71776, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(46, 21, 17, 4, 50927, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 28.8, 3.2, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 1, '', '', 1, 'completed'),
(47, 21, 17, 4, 56484, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(48, 21, 17, 4, 87226, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(49, 21, 17, 4, 6402, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(50, 21, 17, 4, 56252, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(51, 21, 17, 4, 72522, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(52, 21, 17, 4, 23323, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(53, 21, 17, 4, 33056, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(54, 21, 17, 4, 87831, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(55, 21, 17, 4, 33193, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(56, 21, 17, 4, 86526, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(57, 21, 17, 4, 65012, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(58, 21, 17, 4, 23066, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(59, 21, 17, 4, 4906, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(60, 21, 17, 4, 18652, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(61, 21, 17, 4, 47355, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(62, 21, 17, 4, 66691, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(63, 21, 17, 4, 79177, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 28.8, 3.2, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 1, '', '', 1, 'completed'),
(64, 21, 17, 4, 80772, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(65, 21, 17, 4, 76904, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(66, 21, 17, 4, 42408, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(67, 21, 17, 4, 10555, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(68, 21, 17, 4, 38759, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(69, 21, 17, 4, 91634, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(70, 21, 17, 4, 12715, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(71, 21, 17, 4, 34648, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(72, 21, 17, 4, 33217, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(73, 21, 17, 4, 38766, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(74, 21, 17, 4, 32677, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(75, 21, 17, 4, 50782, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(76, 21, 17, 4, 80456, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(77, 21, 17, 4, 85596, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(78, 21, 17, 4, 68583, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(79, 21, 17, 4, 89029, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(80, 21, 17, 4, 95956, 'HnNwSC7WdXVeMZqICGt6LTXfC31Z2SBvuxwIB8YK', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'stripe', '', '2018-09-05', 0, 0, '', '', 0, 'processing'),
(81, 18, 17, 22, 50665, 'uB1sg97zMD97VZlwn7DScovfKG9Yj8w2bnRsQeU2', '', 0, '', 0, '', 0, 240, '10', 207, 23, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-06', 0, 1, '', '', 1, 'completed'),
(82, 18, 17, 22, 34788, 'uB1sg97zMD97VZlwn7DScovfKG9Yj8w2bnRsQeU2', '', 0, '', 0, '', 0, 240, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-06', 0, 0, '', '', 0, 'processing'),
(83, 18, 17, 22, 23132, 'uB1sg97zMD97VZlwn7DScovfKG9Yj8w2bnRsQeU2', '', 0, '', 0, '', 0, 240, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-06', 0, 0, '', '', 0, 'processing'),
(84, 18, 17, 22, 23013, 'uB1sg97zMD97VZlwn7DScovfKG9Yj8w2bnRsQeU2', '', 0, '', 0, '', 0, 240, '10', 0, 0, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-06', 0, 0, '', '', 0, 'processing'),
(85, 22, 49, 48, 2246, 'uSnPyWKkDstl9HfaYhI41Z9m4G7JjfLe9HLkTFnH', '', 0, '', 0, '', 0, 110, '10', 90, 10, 0, 0, '', '0', '0', 'payumoney', '', '2018-09-06', 0, 2, '', '', 1, 'completed'),
(86, 21, 17, 4, 11721, 'KEK1fvQrCQk3nwGz5VWMUG6JOqbAtk2KckpyphlF', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'stripe', '', '2018-09-10', 0, 0, '', '', 0, 'processing'),
(87, 21, 17, 4, 75184, 'KEK1fvQrCQk3nwGz5VWMUG6JOqbAtk2KckpyphlF', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'stripe', '', '2018-09-10', 0, 0, '', '', 0, 'processing'),
(88, 21, 17, 4, 94476, '5ufHY0OiNYDxeP0q3vm2YXBgArDc1uFBXRCDYmxD', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'stripe', '', '2018-09-10', 0, 0, '', '', 0, 'processing'),
(89, 21, 17, 4, 76760, 'KEK1fvQrCQk3nwGz5VWMUG6JOqbAtk2KckpyphlF', '', 0, '', 0, '', 0, 42, '10', 0, 0, 0, 0, '', '0', '0', 'stripe', '', '2018-09-10', 0, 0, '', '', 0, 'processing');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `page_id` int(11) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `page_title`, `page_desc`) VALUES
(1, 'About', '\'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum<br/><br/>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum<br/><br/>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum\''),
(2, 'Terms and Conditions', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum<br/><br/>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum<br/><br/>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum'),
(3, 'Privacy Policy', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum<br/><br/>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum<br/><br/>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum'),
(4, 'Contact', '\'<div style=\"width: 100%\"><iframe width=\"100%\" height=\"300\" src=\"https://www.mapsdirections.info/en/custom-google-maps/map.php?width=100%&height=300&hl=ru&q=London+(Responsive)&ie=UTF8&t=&z=14&iwloc=A&output=embed\" frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\"><a href=\"https://www.mapsdirections.info/en/custom-google-maps/\">Create a custom Google Map</a> by <a href=\"https://www.mapsdirections.info/en/\">UK Maps</a></iframe></div>\''),
(5, 'How it works', '\'lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum<br/><br/>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum<br/><br/>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum\'\'\''),
(6, 'Safety', '\'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum<br/><br/>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum<br/><br/>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum\''),
(7, 'Service Guide', '\'\'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum<br/><br/>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum<br/><br/>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum\'\''),
(8, 'How to pages', '\'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum<br/><br/>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum<br/><br/>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum\''),
(9, 'Sucess Stories', '\'\'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum<br/><br/>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum<br/><br/>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum\'\'');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('customer@customer.com', '$2y$10$i3coxhBectaoxS2e/qfcAOhrFusAd8Cg5NmDkbDwNgnPG076o3Kxi', '2017-05-25 02:14:23'),
('wpchecking@gmail.com', '$2y$10$iN7LOujh2Igb7A9eyHcZE.ejPmY776Mj0MaiFDuXFlfu2WkkdPnxS', '2017-05-25 02:22:43'),
('saravanan@sangvish.com', '$2y$10$B6//ifrFc0QFrUoN32GyCeV9yja7mqGEiOOKhM5SWNyE1Y7ky6HyW', '2018-04-20 06:59:40'),
('seller@seller.com', '$2y$10$Xc8ZSifNFs0mSi1w8huU9eLvuwNvfz3T6BY/X0dUKBX5VUeh7OZUy', '2018-04-20 07:53:10');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rid` int(11) NOT NULL,
  `rating` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `rshop_id` int(50) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rid`, `rating`, `email`, `rshop_id`, `comment`) VALUES
(1, '', 'seller@seller.com', 23, 'Hi this is very nice shopping mall...It\' nice..cool'),
(3, '4', 'customer@customer.com', 24, 'very nice'),
(4, '5', 'customer@customer.com', 22, 'Good shop'),
(5, '3', 'customer@customer.com', 25, 'Well'),
(6, '3', 'customer@customer.com', 26, 'Good mobile shop'),
(7, '4', 'customer@customer.com', 27, 'Fine'),
(8, '5', 'newuser@gmail.com', 28, 'Very Good'),
(10, '3', 'seller@seller.com', 21, 'sample'),
(17, '5', 'testinguse@gmail.com', 22, 'rwar dddd'),
(18, '3', 'testinguse@gmail.com', 25, 'very nice service good...'),
(19, '3', 'seller@seller.com', 28, 'test'),
(20, '3', 'c.saravanan@hotmail.com', 24, 'THis service is very good');

-- --------------------------------------------------------

--
-- Table structure for table `request_file`
--

CREATE TABLE `request_file` (
  `rf_id` int(11) NOT NULL,
  `token_key` varchar(200) NOT NULL,
  `file_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_file`
--

INSERT INTO `request_file` (`rf_id`, `token_key`, `file_name`) VALUES
(1, '5b852cec6be91', '56176.pdf'),
(2, '5b8646202236d', '80015.jpg'),
(3, '5b87de0646f16', '90876.pdf'),
(4, '5b87e35639ff0', '18001.pdf'),
(5, '5b87e7aba704f', '66913.jpeg'),
(6, '5b88d9018c9d4', '52252.jpg'),
(7, '5b8937d3c1cb0', '33531.pdf'),
(8, '5b893bc6d4d5d', '27560.pdf'),
(9, '5b8ce2b12b169', '23485.pdf'),
(10, '5b90c9d1dd24f', '73528.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `request_proposal`
--

CREATE TABLE `request_proposal` (
  `prp_id` int(11) NOT NULL,
  `gid` int(100) NOT NULL,
  `req_user_id` int(100) NOT NULL,
  `prop_user_id` int(100) NOT NULL,
  `bid_price` int(100) NOT NULL,
  `bid_email` varchar(200) NOT NULL,
  `desc_proposal` text NOT NULL,
  `proposal_estimate` varchar(50) NOT NULL,
  `bid_date` date NOT NULL,
  `award` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_proposal`
--

INSERT INTO `request_proposal` (`prp_id`, `gid`, `req_user_id`, `prop_user_id`, `bid_price`, `bid_email`, `desc_proposal`, `proposal_estimate`, `bid_date`, `award`) VALUES
(1, 3, 4, 22, 760, 'customer@gmail.com', 'this is test comment', '10', '2018-08-29', 0),
(2, 3, 4, 17, 35, 'customer1@customer.com', 'i will do the project?', '3', '2018-08-30', 1),
(3, 4, 17, 4, 105, 'seller@seller.com', 'i need your job', '4', '2018-08-30', 1),
(4, 4, 17, 22, 140, 'customer@gmail.com', 'test', '3', '2018-08-30', 0),
(5, 5, 4, 17, 199, 'customer1@customer.com', 'test', '5', '2018-08-30', 1),
(6, 6, 4, 17, 70, 'customer1@customer.com', 'test', '1', '2018-08-30', 1),
(7, 7, 4, 22, 100, 'customer@gmail.com', 'TEST', '123', '2018-08-31', 1),
(8, 7, 4, 17, 15, 'customer1@customer.com', 'et', '12', '2018-08-31', 0),
(9, 8, 4, 17, 500, 'customer1@customer.com', 'can i do?', '6', '2018-08-31', 1),
(10, 9, 17, 4, 36, 'seller@seller.com', 'test', '4', '2018-08-31', 0),
(11, 9, 17, 22, 62, 'customer@gmail.com', 'test', '2', '2018-09-01', 1),
(12, 10, 22, 17, 30, 'customer1@customer.com', 'jjh', '6', '2018-09-03', 1),
(13, 11, 22, 17, 16, 'customer1@customer.com', 'test', '32', '2018-09-03', 1),
(14, 12, 4, 17, 150, 'customer1@customer.com', 'test', '3', '2018-09-03', 1),
(15, 13, 4, 17, 24, 'customer1@customer.com', 'TEST', '5', '2018-09-03', 1),
(16, 14, 4, 22, 5, 'customer@gmail.com', 'ds', '2', '2018-09-03', 1),
(17, 15, 4, 17, 25, 'customer1@customer.com', 'test', '3', '2018-09-03', 1),
(18, 16, 4, 17, 30, 'customer1@customer.com', 'te', '3', '2018-09-03', 1),
(19, 17, 4, 17, 10, 'customer1@customer.com', 'dfsa', '3', '2018-09-03', 1),
(20, 18, 22, 17, 230, 'customer1@customer.com', 'test', '5', '2018-09-05', 1),
(21, 19, 4, 17, 30, 'customer1@customer.com', 'test', '5', '2018-09-05', 1),
(22, 20, 4, 17, 175, 'customer1@customer.com', 'test', '3', '2018-09-05', 1),
(23, 21, 4, 17, 32, 'customer1@customer.com', 'test', '3', '2018-09-05', 1),
(24, 22, 48, 49, 100, 'weldone2@gmail.com', 'test', '3', '2018-09-06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `revenues`
--

CREATE TABLE `revenues` (
  `rwid` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `revenues_token` varchar(255) NOT NULL,
  `total_amount` int(255) NOT NULL,
  `revenues_type` varchar(200) NOT NULL,
  `revenues_status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `revenues`
--

INSERT INTO `revenues` (`rwid`, `user_id`, `revenues_token`, `total_amount`, `revenues_type`, `revenues_status`) VALUES
(1, 17, '5b8ccb68349c5', 72, 'buyer_balance', 'completed'),
(2, 17, '5b8cd12f4a6a9', 72, 'buyer_balance', 'completed'),
(3, 17, '5b8cd244c2e87', 72, 'buyer_balance', 'completed'),
(4, 17, '5b8cd49cb5d03', 72, 'buyer_balance', 'completed'),
(5, 17, '5b8cd9c13b86b', 72, 'buyer_balance', 'completed'),
(6, 17, '5b8cdb2115d06', 72, 'buyer_balance', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `rid` int(11) NOT NULL,
  `gid` int(100) NOT NULL,
  `order_id` int(100) NOT NULL,
  `buyer_id` int(100) NOT NULL,
  `seller_id` int(100) NOT NULL,
  `rate` int(100) NOT NULL,
  `star_rate` int(200) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`rid`, `gid`, `order_id`, `buyer_id`, `seller_id`, `rate`, `star_rate`, `comment`) VALUES
(1, 7, 15, 4, 22, 1, 4, 'it\'s better but not good'),
(2, 6, 14, 4, 17, 0, 1, 'not good'),
(3, 8, 16, 4, 17, 1, 3, 'ok'),
(4, 16, 32, 4, 17, 1, 3, 'good wrk'),
(5, 22, 85, 48, 49, 1, 3, 'good');

-- --------------------------------------------------------

--
-- Table structure for table `seller_services`
--

CREATE TABLE `seller_services` (
  `id` int(11) NOT NULL,
  `service_id` int(50) NOT NULL,
  `subservice_id` int(50) NOT NULL,
  `price` int(50) NOT NULL,
  `time` varchar(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `shop_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seller_services`
--

INSERT INTO `seller_services` (`id`, `service_id`, `subservice_id`, `price`, `time`, `user_id`, `shop_id`) VALUES
(14, 12, 9, 90, '7', 4, 22),
(16, 12, 8, 23, '1', 4, 22),
(18, 14, 16, 12, '1', 4, 22),
(19, 12, 8, 30, '3', 5, 23),
(20, 14, 16, 25, '5', 5, 23),
(21, 8, 21, 150, '7', 5, 23),
(22, 12, 3, 15, '1', 5, 23),
(23, 12, 3, 3, '3', 12, 24),
(24, 12, 4, 1, '2', 12, 24),
(25, 12, 8, 1, '2', 12, 24),
(26, 12, 9, 5, '3', 12, 24),
(27, 13, 10, 2, '5', 12, 24),
(28, 13, 11, 6, '3', 12, 24),
(29, 13, 13, 7, '2', 12, 24),
(30, 14, 14, 6, '4', 12, 24),
(31, 12, 4, 4, '3', 5, 23),
(32, 12, 9, 6, '3', 5, 23),
(33, 13, 10, 2, '1', 5, 23),
(34, 13, 11, 2, '1', 5, 23),
(35, 13, 12, 4, '2', 5, 23),
(36, 13, 13, 4, '2', 5, 23),
(37, 12, 3, 2, '1', 4, 22),
(38, 12, 4, 3, '1', 4, 22),
(39, 13, 10, 4, '2', 4, 22),
(40, 13, 11, 6, '2', 4, 22),
(41, 13, 12, 6, '4', 4, 22),
(42, 13, 13, 1, '2', 4, 22),
(48, 12, 3, 3, '1', 13, 25),
(49, 12, 4, 4, '2', 13, 25),
(50, 12, 8, 5, '3', 13, 25),
(51, 12, 9, 6, '3', 13, 25),
(52, 13, 10, 10, '5', 13, 25),
(53, 13, 11, 23, '2', 13, 25),
(54, 13, 12, 10, '4', 13, 25),
(55, 13, 13, 4, '2', 13, 25),
(56, 14, 14, 2, '2', 13, 25),
(57, 14, 17, 3, '2', 13, 25),
(58, 12, 3, 6, '2', 14, 26),
(59, 12, 4, 2, '1', 14, 26),
(60, 12, 8, 6, '3', 14, 26),
(61, 12, 9, 3, '2', 14, 26),
(62, 13, 10, 2, '1', 14, 26),
(63, 13, 12, 22, '2', 14, 26),
(64, 13, 13, 2, '1', 14, 26),
(65, 14, 14, 2, '1', 14, 26),
(66, 14, 17, 21, '1', 14, 26),
(67, 12, 3, 5, '2', 15, 27),
(68, 12, 4, 3, '1', 15, 27),
(69, 12, 8, 6, '3', 15, 27),
(70, 12, 9, 5, '2', 15, 27),
(71, 13, 10, 10, '2', 15, 27),
(72, 13, 11, 7, '2', 15, 27),
(73, 13, 12, 7, '3', 15, 27),
(74, 13, 13, 10, '5', 15, 27),
(75, 14, 14, 7, '8', 15, 27),
(76, 14, 15, 22, '2', 15, 27),
(77, 12, 3, 10, '2', 16, 28),
(78, 12, 4, 3, '1', 16, 28),
(79, 12, 8, 22, '1', 16, 28),
(80, 12, 9, 11, '1', 16, 28),
(81, 13, 10, 1, '1', 16, 28),
(82, 13, 11, 5, '1', 16, 28),
(83, 13, 12, 4, '2', 16, 28),
(84, 13, 13, 8, '3', 16, 28),
(85, 14, 14, 3, '1', 16, 28),
(86, 14, 15, 8, '3', 16, 28),
(87, 14, 17, 6, '2', 16, 28),
(88, 8, 21, 2, '2', 14, 26),
(98, 12, 4, 15, '3', 22, 31),
(99, 8, 20, 10, '7', 22, 31),
(100, 12, 8, 14, '8', 22, 31),
(101, 12, 3, 10, '2', 18, 40),
(102, 12, 8, 25, '3', 18, 40),
(103, 12, 9, 20, '3', 18, 40),
(104, 13, 11, 36, '6', 22, 31),
(105, 14, 14, 8, '2', 28, 41),
(106, 8, 21, 12, '1', 28, 41),
(107, 12, 8, 6, '3', 28, 41),
(108, 12, 3, 5, '4', 28, 41),
(109, 12, 9, 7, '6', 28, 41),
(110, 12, 8, 20, '1', 33, 42),
(111, 12, 3, 1, '2', 40, 46),
(112, 12, 4, 4, '2', 40, 46),
(113, 12, 4, 100, '5', 52, 49);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `image`, `status`) VALUES
(8, 'Events', '1495189404.png', 1),
(9, 'Home', '1495189518.png', 0),
(10, 'Lessons', '1495189626.png', 0),
(11, 'Wellness', '1495189741.png', 0),
(12, 'Business', '1495189828.png', 0),
(13, 'Crafts', '1495190009.png', 1),
(14, 'Design & Web', '1495190181.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `site_name` varchar(255) NOT NULL,
  `site_desc` text NOT NULL,
  `site_keyword` text NOT NULL,
  `site_ads_space` text CHARACTER SET utf8 NOT NULL,
  `site_facebook` varchar(255) NOT NULL,
  `site_twitter` varchar(255) NOT NULL,
  `site_gplus` varchar(255) NOT NULL,
  `site_pinterest` varchar(255) NOT NULL,
  `site_instagram` varchar(255) NOT NULL,
  `site_currency` varchar(255) NOT NULL,
  `site_logo` varchar(255) NOT NULL,
  `site_favicon` varchar(255) NOT NULL,
  `site_banner` varchar(255) NOT NULL,
  `site_copyright` varchar(255) NOT NULL,
  `commission_mode` varchar(255) NOT NULL,
  `commission_from` varchar(50) NOT NULL,
  `commission_amt` float NOT NULL,
  `paypal_id` varchar(255) NOT NULL,
  `paypal_url` varchar(255) NOT NULL,
  `stripe_mode` varchar(50) NOT NULL,
  `test_publish_key` varchar(200) NOT NULL,
  `test_secret_key` varchar(200) NOT NULL,
  `live_publish_key` varchar(200) NOT NULL,
  `live_secret_key` varchar(200) NOT NULL,
  `payu_mode` varchar(50) NOT NULL,
  `merchant_key` varchar(200) NOT NULL,
  `salt_id` varchar(200) NOT NULL,
  `message_per_page` int(100) NOT NULL,
  `withdraw_amt` float NOT NULL,
  `withdraw_option` varchar(255) NOT NULL,
  `payment_option` varchar(200) NOT NULL,
  `social_login_option` varchar(100) NOT NULL,
  `approve_requests` varchar(200) NOT NULL,
  `min_skills` varchar(200) NOT NULL,
  `max_skills` varchar(200) NOT NULL,
  `featured_gig_price` float NOT NULL,
  `featured_days` int(100) NOT NULL,
  `processing_fee` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `site_desc`, `site_keyword`, `site_ads_space`, `site_facebook`, `site_twitter`, `site_gplus`, `site_pinterest`, `site_instagram`, `site_currency`, `site_logo`, `site_favicon`, `site_banner`, `site_copyright`, `commission_mode`, `commission_from`, `commission_amt`, `paypal_id`, `paypal_url`, `stripe_mode`, `test_publish_key`, `test_secret_key`, `live_publish_key`, `live_secret_key`, `payu_mode`, `merchant_key`, `salt_id`, `message_per_page`, `withdraw_amt`, `withdraw_option`, `payment_option`, `social_login_option`, `approve_requests`, `min_skills`, `max_skills`, `featured_gig_price`, `featured_days`, `processing_fee`) VALUES
(1, 'Tasky', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat', 'lorem,ipsum,lorem,ipsum', '&lt;a href=&quot;#&quot;&gt;&lt;img src=&quot;http://demowpthemes.com/privatemessage/ad.png&quot; border=&quot;0&quot; /&gt;&lt;/a&gt;', 'http://www.facebook.com', 'http://www.twitter.com', 'http://www.google.com', 'http://www.pinterest.com', 'http://www.instagram.com', 'USD', '1544424761.png', '1544448323.png', '1501837831.jpg', '© 2017. All Rights Reserved. Designed by Migrateshop', 'percentage', 'buyer', 10, 'sang_1354798740_biz@gmail.com', 'https://www.sandbox.paypal.com/cgi-bin/webscr', 'test', 'pk_test_bWx1fEQgVZozaQyPZpAjwDMQ', 'sk_test_JKf2bTvOtK7fPFrHoMphlvAV', 'pk_live_fdsafsa', 'sk_live_dafdsfdsadfsa', 'test', 'gtKFFx', 'eCwWELxi', 3, 10, 'paypal,bank,stripe,payumoney', 'paypal,stripe,payumoney', 'GPlus,Facebook,Twitter', 'yes', '2', '10', 15, 10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `id` int(25) NOT NULL,
  `shop_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `pin_code` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `shop_phone_no` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `shop_date` varchar(255) NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `cover_photo` varchar(255) NOT NULL,
  `profile_photo` varchar(255) NOT NULL,
  `shop_document` varchar(500) NOT NULL,
  `seller_email` varchar(250) NOT NULL,
  `user_id` int(50) NOT NULL,
  `featured` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `admin_email_status` varchar(200) NOT NULL,
  `booking_opening_days` varchar(255) NOT NULL,
  `booking_per_hour` varchar(255) NOT NULL,
  `tax_percent` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`id`, `shop_name`, `address`, `city`, `pin_code`, `country`, `state`, `shop_phone_no`, `description`, `shop_date`, `start_time`, `end_time`, `cover_photo`, `profile_photo`, `shop_document`, `seller_email`, `user_id`, `featured`, `status`, `admin_email_status`, `booking_opening_days`, `booking_per_hour`, `tax_percent`) VALUES
(22, 'Dress Shop', '1536 Madison Avenue, New York, NY, USA', 'Tony Tan', '408600', 'Singapore', 'Singapore', '996565', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '0,1,3,6', '3', '16', '1501759346.jpeg', '1496052063.jpg', '1523871105.pdf', 'seller@seller.com', 4, 'no', 'unapproved', '0', '5', '2', 5),
(23, 'Shopping Mall', '65,Main Road,Cross Street', 'EC2N', '55364', 'United Kingdom', 'Lon', '800255104', 'This is shopping mall', '1,2,3,4,5', '5', '22', '1501759508.jpeg', '1496129839.jpg', '', 'sample2@gmail.com', 5, 'no', 'approved', '0', '7', '2', 0),
(24, 'Book Shop', 'No. 9 Sector 16, Panchkula Haryana.', 'Hisar', '134003', 'India', 'Haryana', '666565', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '0,1,2,3,5,6', '10', '21', '1501759634.jpeg', '1497270711.jpg', '', 'demo@demo.com', 12, 'no', 'approved', '0', '4', '2', 0),
(25, 'Cycle Shop', '18, 29th Street, Thillai Ganga Nagar, Nanganallur, Chennai 600061', 'chennai', '600061', 'India', 'Tamilnadu', '3243232', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '0,1,5,6', '4', '18', '1501757735.jpg', '1497271665.jpeg', '', 'example@example.com', 13, 'no', 'approved', '0', '4', '3', 0),
(26, 'Mobile Shop', '76 Lafayette Street, New York, NY, USA', 'Kasaragod', '3242', 'India', 'Kerala', '324324332', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '1,2,3,4,5', '4', '13', '1501758403.jpeg', '1497866493.jpg', '1539078783550.jpg', 'sample@sample.com', 14, 'no', 'approved', '0', '6', '5', 0),
(27, 'Bike Shop', '1 New York State Reference Route 907L, New York, NY, USA', 'Karachi', '32222', 'Pakistan', 'pk', '9383838', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '0,1,2,3,4', '9', '21', '1501758573.jpg', '1497333150.jpeg', '1539078648550.jpg', 'test@test.com', 15, 'no', 'approved', '0', '17', '5', 0),
(28, 'Furniture shop', 'No 23, LADY DOAK COLLEGE ROAD,CHOKKIKULAM,MADURAI', 'Madurai', '625002', 'India', 'Tamilnadu', '565656', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '0,1,2,3,5,6', '2', '22', '1501758828.jpeg', '1497333617.jpeg', '', 'checking@checking.com', 16, 'no', 'unapproved', '0', '6', '5', 0),
(46, 'ds', 's', 's', 's', 's', 's', '324234', 's', '0,1,3,6', '15', '15', '1534415869322.png', '1534415869115.jpg', '1534415869550.jpg', 'best@gmail.com', 40, 'yes', 'unapproved', '1', '3', '2', 3),
(47, 'go', 'test', 'new', '3552', 'india', 'tamilnadu', '93884848', 'test', '0,1,4,5,6', '12', '6', '1538374480322.jpeg', '1538374481115.jpeg', '1538374434550.png', 'newwork@gmail.com', 47, 'no', 'unapproved', '0', '18', '3', 10),
(49, 'sample', '837 Boylston Street, Newton, MA, USA', '', '', '', '', '847477', 'test', '0,1,3,4,5,6', '13', '13', '1539065589322.jpg', '1539065590115.jpg', '1539065590550.jpg', 'woo@gmail.com', 52, 'no', 'approved', '0', '14', '5', 7);

-- --------------------------------------------------------

--
-- Table structure for table `shop_gallery`
--

CREATE TABLE `shop_gallery` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `user_id` int(50) NOT NULL,
  `shop_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_gallery`
--

INSERT INTO `shop_gallery` (`id`, `image`, `user_id`, `shop_id`) VALUES
(6, '1496056954.jpg', 4, 22),
(7, '1496056986.jpg', 4, 22),
(8, '1496130509.jpg', 5, 23),
(9, '1496130517.jpg', 5, 23),
(10, '1496130525.jpg', 5, 23),
(11, '1497944869.jpg', 14, 26),
(12, '1498113425.jpeg', 16, 28),
(13, '1498113479.jpeg', 16, 28),
(14, '1498113521.jpeg', 16, 28);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `skill` varchar(500) NOT NULL,
  `delete_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `skill`, `delete_status`) VALUES
(3, 'HTML', ''),
(4, 'HTML5', ''),
(5, 'CSS', ''),
(6, 'CSS3', ''),
(7, 'CMS', ''),
(8, 'CakePHP', ''),
(9, 'CS-Cart', ''),
(10, 'C++', ''),
(11, 'ASP.NET', ''),
(12, 'API', ''),
(13, 'Codeigniter', ''),
(14, 'Wordpress', ''),
(15, 'Drupal', ''),
(16, 'OpenCart', ''),
(17, 'Magento', ''),
(18, 'Javascript', ''),
(19, 'JQuery', ''),
(20, 'PHP', ''),
(21, 'MySQL', ''),
(22, 'DATABASE', ''),
(23, 'Software Development', '');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `subid` int(11) NOT NULL,
  `subname` varchar(200) NOT NULL,
  `category` int(50) NOT NULL,
  `subimage` varchar(200) NOT NULL,
  `meta_desc` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `featured` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`subid`, `subname`, `category`, `subimage`, `meta_desc`, `meta_keywords`, `featured`) VALUES
(1, 'sample 1', 3, '', 'sample 1', 'sample 1', 'no'),
(2, 'sample 2', 3, '', 'sample 2', 'sample 2', 'no'),
(3, 'test 1', 4, '', 'test 1', 'test 1', 'no'),
(4, 'test 2', 4, '', 'test 2', 'test 2', 'no'),
(5, 'test 3', 4, '', 'test 3', 'test 3', 'no'),
(6, 'Designer', 5, '', 'test', 'test', 'no'),
(7, 'job service', 4, '', 'test', 'tst', 'no'),
(8, 'sales', 10, '', 'hj', 'dfsa', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `subservices`
--

CREATE TABLE `subservices` (
  `subid` int(11) NOT NULL,
  `subname` varchar(255) NOT NULL,
  `service` varchar(255) NOT NULL,
  `subimage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subservices`
--

INSERT INTO `subservices` (`subid`, `subname`, `service`, `subimage`) VALUES
(3, 'Accounting', '12', '1495433279.jpg'),
(4, 'Advertising', '12', '1495433362.jpg'),
(8, 'Data Entry', '12', '1495456036.jpg'),
(9, 'Digital Marketing', '12', '1495456096.jpg'),
(10, 'lighting', '13', '1545308657.jpg'),
(11, 'Paper craft', '13', '1545306342.jpg'),
(12, 'Wooden craft', '13', '1545308485.jpg'),
(13, 'Cloth Bracelets', '13', '1545223428.jpg'),
(14, 'Animation', '14', '1545309844.jpg'),
(15, 'E Commerce', '14', '1545306450.jpg'),
(16, 'Technical Design', '14', '1545221858.jpg'),
(17, 'Software Development', '14', '1545308756.jpg'),
(18, 'Wedding', '8', '1545306867.jpg'),
(19, 'Meeting', '8', '1545300350.jpg'),
(20, 'Photography', '8', '1545306745.jpg'),
(21, 'Cooking', '8', '1545306784.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_private_message`
--

CREATE TABLE `tbl_private_message` (
  `pid` int(11) NOT NULL,
  `sender` varchar(200) NOT NULL,
  `receiver` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `send_by` varchar(50) NOT NULL,
  `read_status` int(50) NOT NULL,
  `submitted` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_private_message`
--

INSERT INTO `tbl_private_message` (`pid`, `sender`, `receiver`, `message`, `send_by`, `read_status`, `submitted`) VALUES
(138, '17', '4', 'gfgfg', 'customer', 0, '2018-04-13 09:31:40'),
(137, '4', '17', 'hi', 'seller', 0, '2018-04-13 09:28:00'),
(136, '4', '17', 'edsfafdsa', 'seller', 0, '2018-04-07 08:27:28'),
(135, '17', '4', 'sample message by customer', 'seller', 0, '2018-04-07 08:26:54'),
(133, '4', '17', 'Test', 'seller', 0, '2018-04-07 08:12:37'),
(134, '4', '15', 'please urgent call me', 'seller', 0, '2018-04-07 08:13:31'),
(131, '4', '12', 'kk', 'seller', 0, '2018-04-07 08:06:45'),
(132, '12', '4', '', 'seller', 0, '2018-04-07 08:06:45'),
(130, '17', '4', 'fdsg', 'customer', 0, '2018-04-07 08:05:07'),
(129, '17', '4', 'Fine :)', 'customer', 0, '2018-04-07 08:03:51'),
(128, '4', '17', 'Thank you :)', 'seller', 0, '2018-04-07 08:03:27'),
(127, '4', '17', '', 'seller', 0, '2018-04-07 08:03:01'),
(115, '4', '15', 'Jooodsfda', 'seller', 0, '2018-04-07 06:10:04'),
(116, '15', '4', '', 'seller', 0, '2018-04-07 06:10:04'),
(117, '15', '4', 'welcome', 'seller', 0, '2018-04-07 06:10:57'),
(118, '13', '4', 'Hi seller', 'seller', 0, '2018-04-07 06:18:23'),
(119, '4', '13', '', 'seller', 0, '2018-04-07 06:18:23'),
(120, '4', '13', 'Hi', 'seller', 0, '2018-04-07 07:40:37'),
(121, '4', '15', 'hi user', 'seller', 0, '2018-04-07 07:43:43'),
(122, '4', '15', 'hi test', 'seller', 0, '2018-04-07 07:43:58'),
(123, '4', '13', 'hello example', 'seller', 0, '2018-04-07 07:52:07'),
(124, '15', '4', 'yes i will call you', 'seller', 0, '2018-04-07 07:52:52'),
(125, '4', '15', 'ok', 'seller', 0, '2018-04-07 07:53:07'),
(126, '17', '4', 'i have checked your shop it\'s really good', 'seller', 0, '2018-04-07 08:03:01'),
(139, '17', '4', 'test', 'customer', 0, '2018-04-13 09:38:22'),
(140, '17', '4', 'please mail me...i think your name is marker', 'customer', 0, '2018-04-13 09:39:15'),
(141, '12', '4', 'sammdf', 'seller', 0, '2018-04-13 10:14:40'),
(142, '12', '4', 'ssara', 'seller', 0, '2018-04-13 10:14:51'),
(143, '12', '4', 'fdsa', 'seller', 0, '2018-04-13 10:15:16'),
(144, '12', '4', 'test', 'seller', 0, '2018-04-13 10:16:02'),
(145, '4', '12', 'ok i will check', 'seller', 0, '2018-04-13 10:17:59'),
(146, '4', '17', 'i will call you', 'seller', 0, '2018-04-13 10:19:04'),
(147, '17', '4', 'kkk', 'customer', 0, '2018-04-13 10:20:19'),
(148, '17', '4', 'check your profile message', 'customer', 0, '2018-04-13 10:20:33'),
(149, '12', '4', 'thankyou', 'seller', 0, '2018-04-13 10:21:01'),
(150, '12', '4', 'we will contact you', 'seller', 0, '2018-04-13 10:21:11'),
(151, '12', '4', 'dfsafdsa', 'seller', 0, '2018-04-13 10:21:16'),
(152, '4', '13', 'jjhhg', 'seller', 1, '2018-04-13 10:33:50'),
(153, '4', '12', 'got it', 'seller', 0, '2018-04-13 10:34:46'),
(154, '4', '12', 'check it', 'seller', 0, '2018-04-13 10:35:04'),
(155, '12', '4', 'finished', 'seller', 1, '2018-04-13 10:35:26'),
(156, '4', '15', 'test fffffffff', 'seller', 1, '2018-04-13 11:18:03'),
(157, '4', '15', 'jhjh', 'seller', 1, '2018-04-13 11:19:46'),
(158, '4', '15', 'dfas', 'seller', 1, '2018-04-13 11:25:26'),
(159, '4', '15', 'sara', 'seller', 1, '2018-04-13 11:25:48'),
(160, '4', '15', 'wel', 'seller', 1, '2018-04-13 11:33:13'),
(161, '4', '15', 'fdsa', 'seller', 1, '2018-04-13 11:38:42'),
(162, '4', '15', 'sample', 'seller', 1, '2018-04-13 11:46:16'),
(163, '4', '15', 'ji', 'seller', 1, '2018-04-13 12:46:32'),
(164, '29', '4', 'your shop is great', 'seller', 0, '2018-04-20 06:13:16'),
(165, '4', '29', '', 'seller', 0, '2018-04-20 06:13:16'),
(166, '29', '18', 'hi', 'seller', 0, '2018-04-20 06:35:25'),
(167, '18', '29', '', 'seller', 0, '2018-04-20 06:35:25'),
(168, '32', '33', 'hi seller', 'seller', 0, '2018-04-20 07:32:21'),
(169, '33', '32', '', 'seller', 0, '2018-04-20 07:32:21'),
(170, '33', '32', 'hi', 'seller', 0, '2018-04-20 07:32:53'),
(171, '1', '4', 'your product is wrong', 'seller', 0, '2018-08-18 07:36:15'),
(172, '4', '1', '', 'seller', 0, '2018-08-18 07:36:15'),
(173, '1', '4', 'tesj', 'seller', 0, '2018-08-18 07:36:53'),
(174, '1', '17', 'i have sent message to vendor', 'customer', 0, '2018-08-18 07:38:22'),
(175, '17', '1', '', 'customer', 0, '2018-08-18 07:38:22'),
(176, '17', '4', 'i need your help', 'customer', 0, '2018-08-30 07:12:53'),
(177, '4', '17', 'yes tell me', 'seller', 0, '2018-08-30 07:13:31'),
(178, '4', '17', 'hi there?', 'seller', 0, '2018-08-30 07:25:13'),
(179, '17', '4', 'yes', 'customer', 0, '2018-08-30 07:26:24'),
(180, '4', '22', 'hi', 'seller', 0, '2018-08-31 08:02:13'),
(181, '22', '4', 'yes', 'seller', 0, '2018-08-31 08:05:24'),
(182, '4', '1', 'ok', 'seller', 1, '2018-09-03 12:14:08'),
(183, '48', '49', 'thanks', 'seller', 0, '2018-09-06 07:03:29'),
(184, '49', '48', 'test', 'seller', 1, '2018-09-06 07:09:37'),
(185, '4', '17', 'hello', 'customer', 0, '2018-09-06 07:53:40'),
(186, '4', '22', 'we', 'seller', 0, '2018-09-06 07:53:53'),
(187, '4', '15', 'hi', 'seller', 0, '2018-09-06 08:07:11'),
(188, '4', '17', 'jkjk', 'seller', 1, '2018-09-08 05:30:42'),
(189, '4', '17', 'bnhgfh', 'customer', 0, '2018-09-08 08:05:38'),
(190, '4', '1', 'fasdfasdf asdfas', 'seller', 1, '2018-12-19 08:29:54'),
(191, '4', '29', 'test', 'seller', 1, '2018-12-19 12:45:54');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `description`, `image`) VALUES
(3, 'Mickey Peter', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '1495604998.jpg'),
(5, 'John', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '1495544971.jpg'),
(6, 'Barbie', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '1495604691.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_id` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` int(11) NOT NULL,
  `wallet` float NOT NULL,
  `confirmation` int(50) NOT NULL,
  `confirm_key` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `provider`, `provider_id`, `gender`, `phone`, `photo`, `admin`, `wallet`, `confirmation`, `confirm_key`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'test@studentsvsteachers.com', '$2y$10$QKmqNVSrMGfkOOXxf9L6mOHS69fmxrlCQu6eSi1JoIOL5cbLHJNQ6', '', '', 'male', '9876543211', '1497867287.jpg', 1, 0, 1, '', 'fPtKnMvEy5hvHj4UxfBG57HbrzeHfQUc1T6zrDtHo4wkH7XkomPDsEavUYEF', '2017-05-25 01:30:45', '2017-05-25 01:30:45'),
(4, 'seller', 'seller@seller.com', '$2y$10$pwVcpcfi9nUebYbOPeH72.Begd5SeSuUhCV8pwgA/n1t9/K7uzDC6', '', '', 'female', '9876543210', '1497510195.jpg', 2, 26.3, 1, '', 'ovWxG5Zy7z8gxbVWKLFtRNvliFpL9M99SRSITXYtzDVNzVoqxkHwWGhBP2cD', '2017-05-29 04:11:47', '2017-05-29 04:11:47'),
(5, 'sample2', 'sample2@gmail.com', '$2y$10$qHHaIBpt631wQ7Jy79bxDOlvziRvVX9bznjRr.XQpOzAWS7OUsKdy', '', '', 'male', '965666536', '', 2, 592, 1, '', 'znrR3MmpQWEAdMLjSFsoK83rh3WXlgrywGSx4WlJluIyaZg4kIQ3osgUWNoe', '2017-05-30 02:00:10', '2017-05-30 02:00:10'),
(12, 'demo', 'demo@demo.com', '$2y$10$3naRLn1sp3BrMsU3TWNS3e1n3RXCByorqWgSFJ82cwJN1LQ.aG6dm', '', '', 'male', '4654546', '', 2, 44, 1, '', 'grOIxjZsyhPOIpl56sOq8UacCFtBEj6lxwTQAlDsTV52h5tFA9UnhJy8kZ58', '2017-06-12 06:52:17', '2017-06-12 06:52:17'),
(13, 'example', 'example@example.com', '$2y$10$t38C7Wffmy2oeEq5JSScBeFgfe.dfLYCoSbX6ZBndc9xkan0pQK8C', '', '', 'male', '2132131', '', 2, 104, 1, '', 'Q473VsnYY5ODmym8NzPaplzQpFfJgOeA2ihlNomawnYRn3YoAVANQCmNXYN4', '2017-06-12 07:11:47', '2017-06-12 07:11:47'),
(14, 'sample', 'sample@sample.com', '$2y$10$QKmqNVSrMGfkOOXxf9L6mOHS69fmxrlCQu6eSi1JoIOL5cbLHJNQ6', '', '', 'male', '32432', '1497864972.jpg', 2, 0, 1, '', 'Te0JPnXNX0Yb6KrePLWXtC0KfuLn0R4muCPLgojLTiXJxne6MtdN6N008nAX', '2017-06-12 07:22:31', '2017-06-12 07:22:31'),
(15, 'test', 'test@test.com', '$2y$10$QKmqNVSrMGfkOOXxf9L6mOHS69fmxrlCQu6eSi1JoIOL5cbLHJNQ6', '', '', 'male', '655554', '', 2, 0, 1, '', 'VZ3PM4pFtFXRoIVfw8UGQulFkxsUZxTg1gRt6iu0cppKuXEpaETKZP1Hrd9V', '2017-06-13 00:18:47', '2017-06-13 00:18:47'),
(16, 'checking', 'checking@checking.com', '$2y$10$F4pp.n0CJTJU6lKAXtVjc.zVGR3Y4VqlUKZPtSVt16fE4QcQmmuAy', '', '', 'male', '3243232', '', 2, 44, 1, '', 'Ribyq1sXB6HRiFqlZfdNMYo2CqIA2k0hnMVCklyItDoVlc0XzvuNW0c4XaQX', '2017-06-13 00:25:28', '2017-06-13 00:25:28'),
(17, 'customer1', 'customer1@customer.com', '$2y$10$3naRLn1sp3BrMsU3TWNS3e1n3RXCByorqWgSFJ82cwJN1LQ.aG6dm', '', '', 'female', '565655', '', 0, 690, 1, '', '9jjNsNKDUgBUf6amF4OUKOl7WHWREkz1hOjnaaW3ic5xPWTTRDFYn5wypN2g', '2017-06-13 02:06:25', '2017-06-13 02:06:25'),
(18, 'vendor', 'vendor@gmail.com', '$2y$10$qedTvlo5BRugLLwq2x4tyuMrTg6xym0JTc1ivl3xcZE.p6W6wRasi', '', '', 'male', '9858554', '', 2, 98.6, 1, '', 'duHfLdyPR82uhYkMPQ259ciItAYTLYCEh2nUQZ2JF48HNoZKPBwrDV9doJ2J', NULL, NULL),
(22, 'customer', 'customer@gmail.com', '$2y$10$YtcIn7SPT1ALMhvqppA7deqb41inT7bGNgHhuTnSSIiNKFWMnSz26', '', '', 'male', '3452342', '', 2, 255.25, 1, '', '2vhxBOyfGgZ1YvpVUfNqfs2INX6JK1LN47lF8FbD1OVeAawzNYvaLmVsL4O4', '2018-04-06 04:22:05', '2018-04-06 04:22:05'),
(25, 'tester', 'tester@gmail.com', '$2y$10$nSEClyWx8YeElTETjrlFGucEPxrC0gJNGaiM4hq5gYJh4sLSAKonm', '', '', 'male', '9876543210', '', 2, 0, 1, '', 'Ggr9N232HUjPTfUfvN6igEFD5RcoyR9sFoXy7wRT4N5QFJYU8oOn5k6lqbdh', NULL, NULL),
(26, 'hh', 'hh@hh.com', '$2y$10$4CfWINeNqqaEqJPc/GR3IuD3EOQ.gAHg3TpguVkU8oz8wha1oDOBm', '', '', 'male', '324234', '', 2, 0, 1, '', 'hM4AMr4hq7fj4s6SHj2tiqths7L1BY8Ny5WhAtLWxO03MUdEl9GxxNI6ihAH', NULL, NULL),
(27, 'vv', 'vv@gmail.com', '$2y$10$Jz1Hse3Haibly5GSXZ8FFuzFyAURCSMg2nXm2yaQlYj3umluF838W', '', '', 'male', '464646', '', 2, 0, 1, '', 'mnXsMdEyi1I7K9SYk3mVCuMuWSJVju8SMUFe8sY1hwu8G2MFIozoBNeBCQrv', NULL, NULL),
(28, 'sample_vendor', 'saravanan@sangvish.com', '$2y$10$4qOkIWok4JxeUg5SOJPk/O0aMiZpLEYhDiRep5XYPA4edzu1YnOSm', '', '', 'male', '9876543212', '1524203272.png', 2, 0, 1, '', 'YdHau72Vp6IKgKxDl9OPvIDLYZDZyBdQ2vyQRJu8grp2MlnEqCWH7EZebCZP', '2018-04-20 05:47:09', '2018-04-20 05:47:09'),
(29, 'sample_customer', 'newsss@gmail.com', '$2y$10$FQwJ0sMgKADClEPDcZnGEuR6PiBvNDxxPjhTyOJNtJFJEXyCB.y/K', '', '', 'male', '54545454', '', 0, 14.5, 1, '', 'eqv50P94f3acstkRCYZr3xaZWbtHrYyeuDiqfPoOTlUdCNunNHQhDa8AvESR', '2018-04-20 05:52:21', '2018-04-20 05:52:21'),
(31, 'alexxiazofia', 'alexxiazofia@gmail.com', '', 'twitter', '910388547730812930', 'female', '4444464', '', 0, 0, 1, '', 'OtgcINmPo8Omb8utFjOPZxLUkvTCWSEb6hqGDayXTiJQzJ0OGylrgOIeLcUQ', '2018-04-20 06:47:02', '2018-04-20 06:47:02'),
(32, 'buyer20', 'buyer20@g.com', '$2y$10$NQfOw.VjOOhz43JpS1dK6O1hTvAGYtWi0Ton68OBSS22AmftAZ5Jy', '', '', 'male', '778745454787', '', 0, 30, 1, '', 'PzXcs3ak2JBpqgmyvW8NRCIZx2wCkpW6xZmAfshCtuIqJ2zrY4zrZvu5RDZG', '2018-04-20 06:50:39', '2018-04-20 06:50:39'),
(33, 'seller20', 'seller20@gmail.com', '$2y$10$iS.6UBVkO1xK6nMZ6DOMzuqMQeTn0nsl0gcpl2tTsE9UIEHu99tiK', '', '', 'female', '87644787', '', 2, 10, 1, '', 'lBUQ2ku7eUpiaV9les6XeZg2KmMJ6RnigNdOKecpWuHinKAcDERDvnQivN6i', '2018-04-20 06:51:40', '2018-04-20 06:51:40'),
(36, 'jj', 'jj@gmail.com', '$2y$10$Am7Uz.2Hw8nIWmhKVgosquHqiiGV7KAsFOcGd7hVB501qLBH/jc2a', '', '', 'female', '324324', '', 0, 2, 1, '', '6CD5Lf8vjW3bOIBPcnvO97mH8jjIXkeKuXF3mLUhVXxgGPA1oNG4L2XlwuM3', '2018-04-20 10:59:43', '2018-04-20 10:59:43'),
(37, 'fdsa', 'fdsa@dfsa.com', '$2y$10$G0KElXnr412rE9U5PKzjx.nAo0hXKkVmhjt8pKUbL5s4e5cVgNNwW', '', '', 'female', '32423', '', 2, 0, 1, '', 'zAXRT4XsymmjmErPOerVBRCT2kjU2mTZ70XioWjpo2OVJ5GYuYrD99c0L4Xh', NULL, NULL),
(40, 'best', 'best@gmail.com', '$2y$10$9EnWd8.rtiSPySsunwghgeyJXWB3Wv9CmBSS0cobUAbF4LC3Gaqye', '', '', 'male', '8558454', '', 2, 0, 1, '', 'QjdxHV5uHfGnAgwHdxRooACHfPbgsE6yxmdpWkzbmY8xBybSMhIm8aFtRpsL', '2018-08-16 04:38:10', '2018-08-16 04:38:10'),
(45, 'samp', 'samp@gmail.com', '$2y$10$uykefZeSJUcaOYmDySs5quoghXONJ2o21Vp/NKaEbxTLj2.paIcbG', '', '', 'male', '32432423', '', 2, 0, 1, '5b75708c5f462', 'ca9CUl0LmnGDLk7Iq6cXs25UxwDYubVNEolHSiI4gPdrQUwl0Rz5ZGjtNBeR', NULL, NULL),
(46, 'checked', 'checked@gmail.com', '$2y$10$cje//Q1Hf6ajqxIVfUfNBODq48xFjkhYt5k5XZP39AVLEOO9aR4KK', '', '', 'male', '956565656', '', 2, 0, 1, '5b767164808b3', 'XOAVaVvU9ZSsQh3CapndqeoiJHyJi7CaLABLg8x3K9r7phy66JUo4nlPKIor', NULL, NULL),
(47, 'newwork', 'newwork@gmail.com', '$2y$10$B.w2o6.zHgkFafosiLXx7e2j/25rgKyhtTcQLP.XSsJrCYeU/i/1.', '', '', 'male', '5441', '', 2, 0, 1, '5b76c93e3643b', 'wZlpyrqpenibvflbgzxHmmLY3iFzLaK4nndJP9begp2MYGwYxqkOmRUxcq3c', NULL, NULL),
(48, 'weldone1', 'weldone1@gmail.com', '$2y$10$lWP5drl.ZeItUlDOIY/EGu.nrZ/eVJ3oqBIsI8VkC9wDv5wJZ2LXy', '', '', 'male', '9876543210', '', 2, 0, 1, '5b90c84be8c3a', 'dP28FIzgfG6bikguM0f6utYdQFjxrNbK9xwD3hXWgOgmhuy7aGvXgqjjGZc2', NULL, NULL),
(49, 'weldone2', 'weldone2@gmail.com', '$2y$10$xm2Rq46lb.5ucjiLNFka0eE2WqpwHl3RvdxRq0cFJPIthg2VBmSNO', '', '', 'male', '987654221', '', 2, 85, 1, '5b90c8944e6c7', 'y4MukJDPGhZIOTxxuOep0u4Du4tXZa9Qh7aMx5Got4QUoggvP4njce0ewV5t', NULL, NULL),
(50, 'customerr', 'customerr@gmail.com', '$2y$10$MXjHK6.mOdGG9u7pY/ARLudNgUbEFhffnDd9KMn0RC7fO/pQmFaCu', '', '', 'male', '879879', '', 2, 0, 1, '5ba22c5c70a33', NULL, NULL, NULL),
(51, 'go', 'go@gmail.com', '$2y$10$hsnTHtQNOmP74tzsjplz6O/N56ZUfdWIm3v.5H8clyMaMPSY.7fhO', '', '', 'male', '3243242', '', 2, 0, 1, '5ba4bf0d150ed', 'ux7872ndwrFZSbrzlG0OjztM4frKUQrzR6ZXjJdhyH1J1fL3mEU2n5OTjDTY', NULL, NULL),
(52, 'woo', 'woo@gmail.com', '$2y$10$JgO/v/tUZkfCXbmfFBsvfezTW71Bv./Dshr5/LSGQONAQYwyO2P.m', '', '', 'male', '9797565656', '', 2, 0, 1, '5bbb4fb9286e4', 'bvwiC4ysN06ZfumLm8Q0DCHDY3hSiVV6ulEkhsqc5W6ZhmJBvwsoTKGerFsC', NULL, NULL),
(53, 'Geechyman', 'nuclearfuzion@yahoo.com', '$2y$10$sq3mkrI8Dm5BfSPD0UVyyehciDf8HcclyQCd7G0DcGFgf51h5Pefi', '', '', 'male', '8437188617', '', 0, 0, 0, '5c52acf48d109', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `withdraw`
--

CREATE TABLE `withdraw` (
  `wid` int(11) NOT NULL,
  `shop_balance` float NOT NULL,
  `withdraw_amt` float NOT NULL,
  `total_balance` float NOT NULL,
  `withdraw_mode` varchar(255) NOT NULL,
  `paypal_id` varchar(255) NOT NULL,
  `stripe_id` varchar(200) NOT NULL,
  `payumoney` varchar(100) NOT NULL,
  `bank_acc_no` varchar(255) NOT NULL,
  `bank_info` varchar(255) NOT NULL,
  `ifsc_code` varchar(255) NOT NULL,
  `user_id` int(50) NOT NULL,
  `withdraw_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `withdraw`
--

INSERT INTO `withdraw` (`wid`, `shop_balance`, `withdraw_amt`, `total_balance`, `withdraw_mode`, `paypal_id`, `stripe_id`, `payumoney`, `bank_acc_no`, `bank_info`, `ifsc_code`, `user_id`, `withdraw_status`) VALUES
(63, 24, 11, 24, 'paypal', 'fdsa@dfsafdsa.com', '', '', '', '', '', 32, 'completed'),
(64, 13, 10, 13, 'stripe', '', 'dfsfdsal@dsakfdsak.com', '', '', '', '', 32, 'completed'),
(65, 12, 10, 12, 'payumoney', '', '', 'sda@gfmail.com', '', '', '', 36, 'completed'),
(66, 30, 30, 30, 'paypal', 'vishnu@ss.com', '', '', '', '', '', 32, 'pending'),
(67, 250, 250, 250, 'paypal', 'asds@aa.com', '', '', '', '', '', 4, 'pending'),
(68, 150, 17, 150, 'paypal', 'fdsa@dfsa.com', '', '', '', '', '', 4, 'pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `available_balance`
--
ALTER TABLE `available_balance`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_vendor`
--
ALTER TABLE `contact_vendor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dispute`
--
ALTER TABLE `dispute`
  ADD PRIMARY KEY (`dispute_id`);

--
-- Indexes for table `gigs`
--
ALTER TABLE `gigs`
  ADD PRIMARY KEY (`gid`);

--
-- Indexes for table `gig_images`
--
ALTER TABLE `gig_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gig_order`
--
ALTER TABLE `gig_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `request_file`
--
ALTER TABLE `request_file`
  ADD PRIMARY KEY (`rf_id`);

--
-- Indexes for table `request_proposal`
--
ALTER TABLE `request_proposal`
  ADD PRIMARY KEY (`prp_id`);

--
-- Indexes for table `revenues`
--
ALTER TABLE `revenues`
  ADD PRIMARY KEY (`rwid`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `seller_services`
--
ALTER TABLE `seller_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_gallery`
--
ALTER TABLE `shop_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`subid`);

--
-- Indexes for table `subservices`
--
ALTER TABLE `subservices`
  ADD PRIMARY KEY (`subid`);

--
-- Indexes for table `tbl_private_message`
--
ALTER TABLE `tbl_private_message`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `withdraw`
--
ALTER TABLE `withdraw`
  ADD PRIMARY KEY (`wid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `available_balance`
--
ALTER TABLE `available_balance`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;

--
-- AUTO_INCREMENT for table `contact_vendor`
--
ALTER TABLE `contact_vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `dispute`
--
ALTER TABLE `dispute`
  MODIFY `dispute_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `gigs`
--
ALTER TABLE `gigs`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `gig_images`
--
ALTER TABLE `gig_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `gig_order`
--
ALTER TABLE `gig_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `request_file`
--
ALTER TABLE `request_file`
  MODIFY `rf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `request_proposal`
--
ALTER TABLE `request_proposal`
  MODIFY `prp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `revenues`
--
ALTER TABLE `revenues`
  MODIFY `rwid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `seller_services`
--
ALTER TABLE `seller_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `shop_gallery`
--
ALTER TABLE `shop_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `subid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subservices`
--
ALTER TABLE `subservices`
  MODIFY `subid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_private_message`
--
ALTER TABLE `tbl_private_message`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `withdraw`
--
ALTER TABLE `withdraw`
  MODIFY `wid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
