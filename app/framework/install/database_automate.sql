
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


CREATE TABLE `settings` (
  `id` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255),
  `setting_key` varchar(255),
  `setting` longtext,
  `ts` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;


--
-- Table structure for table `audit_tbl`
--

CREATE TABLE IF NOT EXISTS `audit_tbl` (
  `A_id` int(10) unsigned NOT NULL,
  `A_book` tinyint(3) unsigned NOT NULL,
  `A_action` tinyint(3) unsigned NOT NULL,
  `A_p_id` int(10) unsigned NOT NULL,
  `A_remark` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `A_user` int(10) unsigned NOT NULL,
  `A_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `card_holder`
--

CREATE TABLE IF NOT EXISTS `card_holder` (
  `DH_id` int(10) unsigned NOT NULL,
  `DH_patient_id` int(10) unsigned NOT NULL,
  `DH_disc_per` decimal(6,2) NOT NULL,
  `DH_validity` tinyint(3) unsigned NOT NULL,
  `DH_date` date NOT NULL,
  `DH_user` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `card_validity`
--

CREATE TABLE IF NOT EXISTS `card_validity` (
  `CV_id` tinyint(2) unsigned NOT NULL,
  `CV_validity` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `card_validity`
--

INSERT INTO `card_validity` (`CV_id`, `CV_validity`) VALUES
(3, '3 Months'),
(6, '6 Months'),
(12, '12 Months'),
(24, '24 Months'),
(36, '36 Months');

-- --------------------------------------------------------

--
-- Table structure for table `counter_tbl`
--

CREATE TABLE IF NOT EXISTS `counter_tbl` (
  `counter_id` tinyint(3) unsigned NOT NULL,
  `counter_value` int(10) unsigned NOT NULL,
  `last_updated_date` date NOT NULL,
  `table_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `field_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `type` char(2) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `counter_tbl`
--

INSERT INTO `counter_tbl` (`counter_id`, `counter_value`, `last_updated_date`, `table_name`, `field_name`, `type`) VALUES
(1, 1, '2016-04-14', 'patient_info', 'PI_id ', 'dd'),
(2, 16, '2015-09-29', 'dr_info', 'dr_id', 'yy'),
(3, 19, '2015-07-27', 'source_tbl', 'source_id', 'yy'),
(4, 1, '2016-02-11', 'emp_tbl', 'ET_id', 'yy'),
(5, 16, '2015-06-21', 'test_category', 'test_category_id', 'yy'),
(6, 0, '2015-07-13', 'pin_tbl', 'not used', 'yy'),
(7, 8, '2015-07-04', 'state_tbl', 'state_id', 'yy'),
(8, 17, '2015-07-22', 'district_tbl', 'district_id', 'yy'),
(9, 3, '2015-06-24', 'price_version', 'PV_id', 'yy'),
(10, 440, '2015-06-24', 'test_tbl', 'test_id', 'mm'),
(11, 1, '2015-05-25', 'track_users_tbl', 'TU_sl', 'dd'),
(12, 1, '2016-03-29', 'discount_tbl', 'disc_code_sl', 'dd'),
(13, 1, '2016-04-14', 'patient_transaction', 'TR_id', 'dd'),
(14, 1, '2016-04-14', 'patient_registration', 'pr_receipt_no', 'dd'),
(15, 418, '2015-07-21', 'price_dump', 'PD_sl', 'yy'),
(16, 1, '2016-04-14', 'patient_test', 'PT_sl', 'dd'),
(17, 1, '2015-07-22', 'dr_clinic_tbl', 'dr_clinic_id', 'yy'),
(18, 1, '2015-07-22', 'dr_family_tbl', 'dr_family_id', 'yy'),
(19, 1, '2016-02-25', 'department_tbl', 'dept_id', 'yy'),
(20, 6, '2015-08-28', 'designation_tbl', 'designation_id', 'yy'),
(21, 1, '2015-06-20', 'emp_qualification', 'EQ_id', 'yy'),
(22, 1, '2015-06-24', 'emp_experience', 'PE_id', 'yy'),
(23, 10, '2015-08-20', 'referred_tbl', 'referred_id', 'yy'),
(24, 1, '2016-04-14', 'patient_payment', 'PP_sl', 'dd'),
(25, 1, '2014-01-04', 'patient_receipt_status', 'PRS_sl', 'yy'),
(26, 3, '2015-06-20', 'employee_letter', 'EL_sl', 'yy'),
(27, 17, '2016-04-06', 'user_table', 'user_id', 'yy'),
(28, 5, '2014-01-17', 'user_technician_tbl', 'UTC_id', 'yy'),
(29, 2, '2016-04-18', 'expenditure', 'EX_id', 'dd'),
(30, 1, '2015-05-27', 'patient_due_tbl(not used)', 'PD_sl', 'dd'),
(31, 1, '2015-07-17', 'template_name', 'TPN_id', 'dd'),
(32, 1, '2015-07-17', 'template_body', 'TPB_id', 'dd'),
(33, 1, '2016-04-14', 'card_holder', 'DH_id', 'dd'),
(34, 1, '2016-04-14', 'patient_history', 'PH_id', 'dd'),
(35, 1, '2016-04-14', 'lab_note', 'LB_id', 'dd'),
(36, 1, '2015-07-21', 'patient_test_path', 'PTP_id', 'dd'),
(37, 1, '2016-04-14', 'tax_tbl', 'TX_id', 'dd'),
(38, 1, '2016-02-11', 'emp_info', 'EI_id', 'yy'),
(39, 1, '2016-02-11', 'emp_family', 'EF_id', 'yy'),
(40, 1, '2016-02-11', 'emp_cur_address', 'ECA_id', 'yy'),
(41, 3, '2015-06-20', 'emp_exit_tbl', 'EE_id', 'yy'),
(42, 3, '2016-04-18', 'audit_tbl', 'A_id', 'dd'),
(43, 14, '2015-09-03', 'dr_profile', 'dp_id', 'yy'),
(44, 1, '2015-07-01', 'dr_cur_address', 'DCA_id', 'yy'),
(45, 0, '0000-00-00', '', '', ''),
(46, 0, '0000-00-00', '', '', ''),
(47, 0, '0000-00-00', '', '', ''),
(48, 0, '0000-00-00', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `department_tbl`
--

CREATE TABLE IF NOT EXISTS `department_tbl` (
  `department_id` tinyint(3) unsigned NOT NULL,
  `department_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `department_tbl`
--

INSERT INTO `department_tbl` (`department_id`, `department_name`) VALUES
(20, 'Accounts'),
(18, 'Consultant Microbiologist'),
(17, 'Consultant Pathologist'),
(7, 'ECG'),
(24, 'Endoscopy'),
(3, 'Front Desk'),
(23, 'House keeping'),
(9, 'HR'),
(5, 'LAB'),
(12, 'Marketing'),
(19, 'Medical Transcript'),
(4, 'Sample Collection'),
(14, 'Security'),
(13, 'Stock and Purchase'),
(1, 'Super User'),
(2, 'System Admin'),
(6, 'Ultrasound'),
(8, 'X-Ray');

-- --------------------------------------------------------

--
-- Table structure for table `designation_tbl`
--

CREATE TABLE IF NOT EXISTS `designation_tbl` (
  `designation_id` tinyint(3) NOT NULL,
  `designation_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `short_form` varchar(8) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `designation_tbl`
--

INSERT INTO `designation_tbl` (`designation_id`, `designation_name`, `short_form`) VALUES
(1, 'Managing Director', 'MD'),
(2, 'General Manager', 'GM'),
(3, 'Assistant General Manager', 'AGM'),
(4, 'Public Relation Officer', 'PRO'),
(5, 'Manager Operation', 'MO'),
(6, 'Accountant General Manager', 'ACGM'),
(7, 'Lab Manager', 'LMG'),
(8, 'Supervisor', 'SV'),
(9, 'In-charge', 'IC'),
(10, 'Assistant Incharge', 'ASI'),
(11, 'Senior Staff', 'SS'),
(12, 'Junior Staff', 'JS'),
(13, 'Staff on Probation', 'SOB'),
(14, 'RUNNER', 'RN'),
(15, 'ASSISTANT MANAGER', 'AM'),
(127, 'Front Desk Assistant', 'FDA');

-- --------------------------------------------------------

--
-- Table structure for table `discount_tbl`
--

CREATE TABLE IF NOT EXISTS `discount_tbl` (
  `disc_code_sl` int(10) unsigned NOT NULL,
  `disc_receipt_no` int(10) unsigned NOT NULL,
  `disc_type` tinyint(1) NOT NULL,
  `disc_value` decimal(6,2) NOT NULL,
  `disc_remark` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `disc_user` int(10) unsigned NOT NULL,
  `disc_status_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `discount_tbl`
--

INSERT INTO `discount_tbl` (`disc_code_sl`, `disc_receipt_no`, `disc_type`, `disc_value`, `disc_remark`, `disc_user`, `disc_status_date`) VALUES
(15811, 15811, 2, '20.00', 'locality', 2, '2015-08-02 09:50:48'),
(15832, 15831, 2, '50.00', 'Locallity', 2, '2015-08-03 06:50:46'),
(15863, 157304, 2, '60.00', 'locallity', 2, '2015-08-06 07:54:21'),
(15864, 157303, 2, '60.00', 'locallity', 2, '2015-08-06 07:56:39'),
(15911, 15912, 2, '20.00', 'locality', 2, '2015-09-01 15:24:20'),
(15972, 79151, 2, '10.00', 'locality', 2, '2015-09-07 09:51:53'),
(15973, 49151, 2, '80.00', '80', 2, '2015-09-07 12:19:22'),
(15994, 99151, 2, '50.00', 'locality', 2, '2015-09-09 11:43:48'),
(15995, 99152, 2, '50.00', 'locanlity', 2, '2015-09-09 11:42:53'),
(157271, 157274, 2, '90.00', 'ranjan dicounted', 2, '2015-07-27 18:41:22'),
(157292, 157291, 2, '20.00', 'staf', 2, '2015-07-29 11:52:28'),
(157301, 157301, 2, '610.00', 'relative', 2, '2015-07-30 17:17:19'),
(157302, 157302, 2, '150.00', 'locality', 2, '2015-07-30 17:18:26'),
(157303, 157305, 2, '40.00', 'locality', 2, '2015-07-30 17:23:48'),
(157304, 157307, 2, '10.00', 'locality', 2, '2015-07-30 17:25:32'),
(157305, 157309, 2, '20.00', 'locality', 2, '2015-07-30 17:29:25'),
(157306, 1573010, 2, '10.00', 'locality', 2, '2015-07-30 17:30:12'),
(157307, 1573011, 2, '10.00', 'locality', 2, '2015-07-30 17:31:27'),
(157308, 1573013, 2, '10.00', 'locality', 2, '2015-07-30 17:32:39'),
(157309, 1573018, 2, '10.00', 'locality', 2, '2015-07-30 17:33:34'),
(158111, 158112, 2, '30.00', 'locallity', 2, '2015-08-11 18:12:45'),
(158151, 158151, 2, '200.00', 'ranjan', 2, '2015-08-15 14:51:18'),
(158182, 158183, 1, '30.00', 'Phayeng staf', 2, '2015-08-18 10:09:49'),
(158183, 158182, 1, '30.00', 'phayeng staf', 2, '2015-08-18 10:10:52'),
(158184, 158181, 1, '30.00', 'phayeng staf', 2, '2015-08-18 10:12:09'),
(158241, 157273, 2, '50.00', 'seasonal discount', 2, '2015-08-24 15:11:42'),
(159106, 109151, 2, '20.00', 'locallity', 2, '2015-09-10 16:08:44'),
(1573010, 1573021, 2, '10.00', 'locality', 2, '2015-07-30 17:34:19'),
(1573011, 1573022, 2, '10.00', 'locality', 2, '2015-07-30 17:34:57'),
(1573012, 1573026, 2, '100.00', 'locality', 2, '2015-07-30 17:39:26'),
(1573113, 157311, 2, '70.00', ' locality', 2, '2015-07-31 11:47:52'),
(2109151, 2109151, 2, '20.00', 'locallity', 2, '2015-09-21 10:11:38'),
(2109152, 2109152, 2, '20.00', 'locallity', 2, '2015-09-21 10:12:41'),
(2209151, 2209151, 2, '20.00', 'locallity', 2, '2015-09-22 11:06:08'),
(2609152, 2509152, 2, '20.00', 'locality', 2, '2015-09-26 10:21:17'),
(2709151, 2709152, 2, '50.00', 'locality', 2, '2015-09-27 14:31:15'),
(2909152, 2909151, 2, '60.00', 'locallity', 2, '2015-09-29 09:34:27');

-- --------------------------------------------------------

--
-- Table structure for table `district_tbl`
--

CREATE TABLE IF NOT EXISTS `district_tbl` (
  `district_id` smallint(5) unsigned NOT NULL,
  `district_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `state_id` tinyint(3) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `district_tbl`
--

INSERT INTO `district_tbl` (`district_id`, `district_name`, `state_id`) VALUES
(1, 'Imphal East', 1),
(2, 'Imphal West', 1),
(3, 'Thoubal', 1),
(4, 'Bishnupur', 1),
(5, 'Churachandpur', 1),
(6, 'Chandel', 1),
(7, 'Tamenglong', 1),
(8, 'Ukhrul', 1),
(9, 'Senapati', 1),
(10, 'Dispur', 4),
(11, 'Tamu', 8),
(12, 'Burma', 8),
(13, 'NALANDA', 9),
(14, 'Kohima', 7),
(15, 'Cachar', 4),
(16, 'Wokha', 7);

-- --------------------------------------------------------

--
-- Table structure for table `dr_clinic_tbl`
--

CREATE TABLE IF NOT EXISTS `dr_clinic_tbl` (
  `DC_id` smallint(5) unsigned NOT NULL,
  `DC_dr_id` smallint(5) unsigned NOT NULL,
  `DC_clinic` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `DC_address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `DC_phone` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dr_cur_address`
--

CREATE TABLE IF NOT EXISTS `dr_cur_address` (
  `DCA_id` smallint(5) unsigned NOT NULL,
  `DCA_dr_id` smallint(5) unsigned NOT NULL,
  `DCA_address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `DCA_state` tinyint(5) unsigned NOT NULL,
  `DCA_district` smallint(5) unsigned NOT NULL,
  `DCA_pin` varchar(6) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dr_family_tbl`
--

CREATE TABLE IF NOT EXISTS `dr_family_tbl` (
  `DF_id` smallint(5) unsigned NOT NULL,
  `DF_dr_id` smallint(5) unsigned NOT NULL,
  `DF_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `DF_relation` tinyint(2) unsigned NOT NULL,
  `DF_dob` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dr_info`
--

CREATE TABLE IF NOT EXISTS `dr_info` (
  `dr_id` int(10) unsigned NOT NULL,
  `dr_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dr_phone` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `dr_email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `dr_dob` date NOT NULL,
  `dr_address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dr_state` tinyint(3) unsigned NOT NULL,
  `dr_district` smallint(5) unsigned NOT NULL,
  `dr_pin` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `dr_gender` tinyint(3) unsigned NOT NULL,
  `dr_marital` tinyint(3) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dr_profile`
--

CREATE TABLE IF NOT EXISTS `dr_profile` (
  `dp_id` int(10) unsigned NOT NULL,
  `dp_dr_id` int(10) unsigned NOT NULL,
  `dp_specialization` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dp_designation` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dp_institute` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emp_cur_address`
--

CREATE TABLE IF NOT EXISTS `emp_cur_address` (
  `ECA_id` smallint(5) unsigned NOT NULL,
  `ECA_ei_id` smallint(5) unsigned NOT NULL,
  `ECA_address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ECA_state` tinyint(3) unsigned NOT NULL,
  `ECA_district` smallint(5) unsigned NOT NULL,
  `ECA_pin` char(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emp_exit_tbl`
--

CREATE TABLE IF NOT EXISTS `emp_exit_tbl` (
  `EE_id` smallint(5) unsigned NOT NULL,
  `EE_ei_id` smallint(5) unsigned NOT NULL,
  `EE_reason` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `EE_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emp_family`
--

CREATE TABLE IF NOT EXISTS `emp_family` (
  `EF_id` smallint(5) unsigned NOT NULL,
  `EF_ei_id` smallint(5) unsigned NOT NULL,
  `EF_type` tinyint(2) unsigned NOT NULL,
  `EF_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `EF_occupation` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `EF_dob` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emp_info`
--

CREATE TABLE IF NOT EXISTS `emp_info` (
  `EI_id` smallint(5) unsigned NOT NULL,
  `EI_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `EI_dob` date NOT NULL,
  `EI_gender` tinyint(1) unsigned NOT NULL,
  `EI_marital` tinyint(1) unsigned NOT NULL,
  `EI_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `EI_phone` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `EI_emergency` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `EI_address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `EI_state` tinyint(3) unsigned NOT NULL,
  `EI_district` smallint(5) unsigned NOT NULL,
  `EI_pin` varchar(6) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emp_letter`
--

CREATE TABLE IF NOT EXISTS `emp_letter` (
  `EL_id` smallint(5) unsigned NOT NULL,
  `EL_ei_id` smallint(5) unsigned NOT NULL,
  `EL_type` tinyint(2) unsigned NOT NULL,
  `EL_remark` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `EL_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emp_prev_experience`
--

CREATE TABLE IF NOT EXISTS `emp_prev_experience` (
  `PE_id` smallint(5) unsigned NOT NULL,
  `PE_ei_id` smallint(5) unsigned NOT NULL,
  `PE_org` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `PE_address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `PE_dept` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `PE_position` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `PE_joined_date` date NOT NULL,
  `PE_exit_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emp_qualification`
--

CREATE TABLE IF NOT EXISTS `emp_qualification` (
  `emp_qualf_id` int(5) NOT NULL,
  `EQ_emp_sl` int(5) NOT NULL,
  `emp_qualf_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `emp_faculty` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `emp_institute` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `emp_univ` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mark_obtained` int(5) NOT NULL,
  `total_mark` int(5) NOT NULL,
  `per_grad` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `result` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `passing_year` int(5) NOT NULL,
  `course_duration` varchar(5) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emp_tbl`
--

CREATE TABLE IF NOT EXISTS `emp_tbl` (
  `ET_id` smallint(5) unsigned NOT NULL,
  `ET_ei_id` smallint(5) unsigned NOT NULL,
  `ET_emp_no` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ET_dept_id` tinyint(3) unsigned NOT NULL,
  `ET_desig_id` tinyint(3) unsigned NOT NULL,
  `ET_report_to` tinyint(3) unsigned NOT NULL,
  `ET_join_date` date NOT NULL,
  `ET_salary` decimal(8,2) NOT NULL,
  `ET_ctc` decimal(10,2) NOT NULL,
  `ET_status` tinyint(3) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `emp_tbl`
--

INSERT INTO `emp_tbl` (`ET_id`, `ET_ei_id`, `ET_emp_no`, `ET_dept_id`, `ET_desig_id`, `ET_report_to`, `ET_join_date`, `ET_salary`, `ET_ctc`, `ET_status`) VALUES
(151, 154, '12312', 8, 13, 4, '2015-09-03', '23123.00', '123123.00', 1),
(152, 155, 'RDIMF06003', 3, 127, 1, '2015-06-01', '1000.00', '12000.00', 1),
(153, 156, 'RDIMF06001', 5, 7, 1, '2015-09-04', '3000.00', '36000.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `expenditure`
--

CREATE TABLE IF NOT EXISTS `expenditure` (
  `EX_id` int(10) unsigned NOT NULL,
  `EX_voucher` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `EX_particular` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `EX_person` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `EX_amount` decimal(8,2) NOT NULL,
  `EX_date` datetime NOT NULL,
  `EX_user` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `expenditure`
--

INSERT INTO `expenditure` (`EX_id`, `EX_voucher`, `EX_particular`, `EX_person`, `EX_amount`, `EX_date`, `EX_user`) VALUES
(164181, 'SG164181', 'Cancelled : Registration # 604161 ( ReasonReson for cancellation )', '604161', '33434.00', '2016-04-18 09:40:15', 2);

-- --------------------------------------------------------

--
-- Table structure for table `gender_tbl`
--

CREATE TABLE IF NOT EXISTS `gender_tbl` (
  `gender_id` tinyint(1) unsigned NOT NULL,
  `gender_name` varchar(6) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gender_tbl`
--

INSERT INTO `gender_tbl` (`gender_id`, `gender_name`) VALUES
(1, 'Male'),
(2, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `lab_note`
--

CREATE TABLE IF NOT EXISTS `lab_note` (
  `LB_id` int(10) unsigned NOT NULL,
  `LB_receipt_no` int(10) unsigned NOT NULL,
  `LB_note` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `LB_date` date NOT NULL,
  `LB_user` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lab_status`
--

CREATE TABLE IF NOT EXISTS `lab_status` (
  `LAB_status_sl` int(10) NOT NULL,
  `LAB_status_receipt_no` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `LAB_status_id` int(2) NOT NULL,
  `LAB_status_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `letter_type_tbl`
--

CREATE TABLE IF NOT EXISTS `letter_type_tbl` (
  `letter_type_id` tinyint(2) unsigned NOT NULL,
  `letter_type` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `letter_type_tbl`
--

INSERT INTO `letter_type_tbl` (`letter_type_id`, `letter_type`) VALUES
(1, 'Appointment Letter'),
(2, 'Approval Letter'),
(3, 'Increment Letter'),
(4, 'General Notice'),
(5, 'Warning Letter'),
(6, 'Releaving Letter'),
(7, 'Termination Letter'),
(8, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `marital_tbl`
--

CREATE TABLE IF NOT EXISTS `marital_tbl` (
  `marital_id` tinyint(1) unsigned NOT NULL,
  `marital_name` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `marital_tbl`
--

INSERT INTO `marital_tbl` (`marital_id`, `marital_name`) VALUES
(1, 'Single'),
(2, 'Married'),
(3, 'Divorcee'),
(4, 'Widow'),
(5, 'Widower'),
(6, 'Child'),
(7, 'Infant');

-- --------------------------------------------------------

--
-- Table structure for table `patient_history`
--

CREATE TABLE IF NOT EXISTS `patient_history` (
  `PH_id` int(10) unsigned NOT NULL,
  `PH_patient_id` int(10) unsigned NOT NULL,
  `PH_history` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_info`
--

CREATE TABLE IF NOT EXISTS `patient_info` (
  `PI_id` int(10) unsigned NOT NULL,
  `PI_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `PI_age_y` tinyint(3) unsigned NOT NULL,
  `PI_age_m` tinyint(2) unsigned NOT NULL,
  `PI_age_d` tinyint(2) unsigned NOT NULL,
  `PI_gender` tinyint(1) unsigned NOT NULL,
  `PI_marital_id` tinyint(1) unsigned NOT NULL,
  `PI_address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `PI_state_id` tinyint(3) unsigned NOT NULL,
  `PI_district_id` smallint(5) unsigned NOT NULL,
  `PI_pin` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `PI_phone` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `PI_date` datetime NOT NULL,
  `PI_card` tinyint(1) unsigned NOT NULL,
  `PI_user` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_payment`
--

CREATE TABLE IF NOT EXISTS `patient_payment` (
  `PP_sl` int(10) unsigned NOT NULL,
  `PP_receipt_no` int(10) unsigned NOT NULL,
  `PP_total` decimal(8,2) NOT NULL,
  `PP_tax` tinyint(1) unsigned NOT NULL,
  `PP_disc` tinyint(1) unsigned NOT NULL,
  `PP_net` decimal(8,2) NOT NULL,
  `PP_paid` decimal(8,2) NOT NULL,
  `PP_date` datetime NOT NULL,
  `PP_bal` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `patient_payment`
--

INSERT INTO `patient_payment` (`PP_sl`, `PP_receipt_no`, `PP_total`, `PP_tax`, `PP_disc`, `PP_net`, `PP_paid`, `PP_date`, `PP_bal`) VALUES
(604161, 604161, '0.00', 2, 2, '0.00', '0.00', '2016-04-06 23:09:35', '0.00'),
(2903162, 2903162, '1380.00', 2, 2, '1380.00', '1380.00', '2016-03-29 22:28:29', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `patient_registration`
--

CREATE TABLE IF NOT EXISTS `patient_registration` (
  `pr_receipt_no` int(10) unsigned NOT NULL,
  `pr_patient_id` int(10) unsigned NOT NULL,
  `pr_dr_prescription` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `pr_status_id` tinyint(3) unsigned NOT NULL,
  `pr_source_id` tinyint(3) unsigned NOT NULL,
  `pr_referred_id` smallint(5) unsigned NOT NULL,
  `pr_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_test`
--

CREATE TABLE IF NOT EXISTS `patient_test` (
  `PT_sl` int(10) unsigned NOT NULL,
  `PT_receipt_no` int(10) unsigned NOT NULL,
  `PT_test_id` bigint(10) NOT NULL,
  `PT_test_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `PT_test_price` decimal(8,2) NOT NULL,
  `PT_dept_id` tinyint(3) unsigned NOT NULL,
  `PT_status_id` tinyint(3) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `patient_test`
--

INSERT INTO `patient_test` (`PT_sl`, `PT_receipt_no`, `PT_test_id`, `PT_test_name`, `PT_test_price`, `PT_dept_id`, `PT_status_id`) VALUES
(15811, 15811, 167, 'Sugar (Fasting)', '100.00', 5, 5),
(15813, 15812, 28, 'Blood Grouping', '90.00', 5, 5),
(15814, 15813, 209, 'Urine RE', '130.00', 5, 5),
(15815, 15814, 209, 'Urine RE', '130.00', 5, 5),
(15821, 15811, 168, 'Sugar (PP)', '100.00', 5, 5),
(15831, 15831, 112, 'Malarial Parasite (OMT)', '350.00', 5, 5),
(15832, 15831, 167, 'Sugar (Fasting)', '100.00', 5, 5),
(15833, 15831, 386, 'Typhidot / Enteriocheck', '350.00', 5, 5),
(15834, 15832, 167, 'Sugar (Fasting)', '100.00', 5, 5),
(15835, 15832, 168, 'Sugar (PP)', '100.00', 5, 5),
(15841, 15841, 167, 'Sugar (Fasting)', '100.00', 5, 5),
(15842, 15841, 168, 'Sugar (PP)', '100.00', 5, 5),
(15843, 15842, 28, 'Blood Grouping', '90.00', 5, 3),
(15844, 15843, 28, 'Blood Grouping', '90.00', 5, 5),
(15845, 15844, 46, 'Complete Haemogram', '400.00', 5, 5),
(15846, 15844, 102, 'KIDNEY FUNCTION TEST/RENAL FUNCTION TEST', '580.00', 5, 5),
(15847, 15844, 107, 'LIVER FUNCTION TEST', '650.00', 5, 5),
(15848, 15845, 46, 'Complete Haemogram', '400.00', 5, 5),
(15849, 15845, 102, 'KIDNEY FUNCTION TEST/RENAL FUNCTION TEST', '580.00', 5, 5),
(15872, 15871, 77, 'Glycosylated (HBA 1C)', '490.00', 5, 5),
(15881, 15881, 84, 'Haemoglobin', '80.00', 5, 5),
(15882, 15881, 28, 'Blood Grouping', '90.00', 5, 5),
(15883, 15881, 209, 'Urine RE', '130.00', 5, 5),
(15884, 15881, 169, 'Sugar (Random)', '100.00', 5, 5),
(15885, 15881, 174, 'Thyroid Stimulating Hormone', '260.00', 5, 5),
(15886, 15881, 69, 'Free - T4', '350.00', 5, 5),
(15887, 15881, 89, 'Hepatitis C ', '450.00', 5, 5),
(15888, 15881, 85, 'HBsAg', '280.00', 5, 5),
(15889, 15882, 46, 'Complete Haemogram', '400.00', 5, 5),
(15891, 15891, 84, 'Haemoglobin', '80.00', 5, 5),
(15911, 15911, 46, 'Complete Haemogram', '400.00', 5, 5),
(15912, 15911, 112, 'Malarial Parasite (OMT)', '350.00', 5, 5),
(15913, 15911, 386, 'Typhidot / Enteriocheck', '350.00', 5, 5),
(15914, 15912, 167, 'Sugar (Fasting)', '100.00', 5, 5),
(15915, 15912, 168, 'Sugar (PP)', '100.00', 5, 5),
(15916, 15913, 187, 'Uric Acid', '150.00', 5, 5),
(15931, 15931, 46, 'Complete Haemogram', '400.00', 5, 5),
(15932, 15932, 187, 'Uric Acid', '150.00', 5, 5),
(15934, 15933, 89, 'Hepatitis C ', '450.00', 5, 5),
(15935, 15934, 46, 'Complete Haemogram', '400.00', 5, 5),
(15936, 15933, 85, 'HBsAg', '280.00', 5, 5),
(15937, 15935, 169, 'Sugar (Random)', '100.00', 5, 5),
(15938, 15936, 216, 'Widal', '180.00', 5, 5),
(15941, 49151, 159, 'SGOT / AST', '130.00', 5, 5),
(15942, 49151, 160, 'SGPT / ALT', '130.00', 5, 5),
(15943, 49151, 28, 'Blood Grouping', '90.00', 5, 5),
(15945, 49151, 29, 'Blood RE', '300.00', 5, 5),
(15946, 49152, 110, 'Lipid Profile', '700.00', 5, 5),
(15947, 49152, 174, 'Thyroid Stimulating Hormone', '260.00', 5, 5),
(15948, 49152, 77, 'Glycosylated (HBA 1C)', '490.00', 5, 5),
(15949, 49152, 167, 'Sugar (Fasting)', '100.00', 5, 5),
(15971, 79151, 28, 'Blood Grouping', '90.00', 5, 5),
(15981, 89151, 28, 'Blood Grouping', '90.00', 5, 5),
(15982, 89151, 29, 'Blood RE', '300.00', 5, 5),
(15983, 89151, 187, 'Uric Acid', '150.00', 5, 5),
(15984, 89151, 102, 'KIDNEY FUNCTION TEST/RENAL FUNCTION TEST', '580.00', 5, 5),
(15985, 89151, 107, 'LIVER FUNCTION TEST', '650.00', 5, 5),
(15986, 89151, 110, 'Lipid Profile', '700.00', 5, 5),
(15987, 89151, 169, 'Sugar (Random)', '100.00', 5, 5),
(15988, 89152, 46, 'Complete Haemogram', '400.00', 5, 5),
(15989, 89153, 169, 'Sugar (Random)', '100.00', 5, 5),
(15991, 99151, 167, 'Sugar (Fasting)', '100.00', 5, 5),
(15992, 99151, 168, 'Sugar (PP)', '100.00', 5, 5),
(15993, 99152, 110, 'Lipid Profile', '700.00', 5, 5),
(15994, 99152, 167, 'Sugar (Fasting)', '100.00', 5, 5),
(15995, 99152, 168, 'Sugar (PP)', '100.00', 5, 5),
(15996, 99153, 169, 'Sugar (Random)', '100.00', 5, 5),
(15997, 99153, 110, 'Lipid Profile', '700.00', 5, 5),
(15998, 99154, 167, 'Sugar (Fasting)', '100.00', 5, 5),
(15999, 99154, 168, 'Sugar (PP)', '100.00', 5, 5),
(151011, 110151, 203, 'Urine Culture And Sensitivity', '430.00', 5, 5),
(151012, 110152, 203, 'Urine Culture And Sensitivity', '430.00', 5, 5),
(151013, 110153, 84, 'Haemoglobin', '80.00', 5, 5),
(151014, 110154, 33, 'Calcium', '160.00', 5, 5),
(151015, 110154, 46, 'Complete Haemogram', '400.00', 5, 5),
(151016, 110155, 102, 'KIDNEY FUNCTION TEST/RENAL FUNCTION TEST', '580.00', 5, 5),
(151017, 110155, 107, 'LIVER FUNCTION TEST', '650.00', 5, 5),
(151021, 210151, 174, 'Thyroid Stimulating Hormone', '260.00', 5, 1),
(151022, 210152, 169, 'Sugar (Random)', '100.00', 5, 1),
(151023, 210152, 84, 'Haemoglobin', '80.00', 5, 1),
(151024, 210152, 53, 'Creatinine', '120.00', 5, 1),
(151025, 210153, 107, 'LIVER FUNCTION TEST', '650.00', 5, 1),
(157261, 157261, 1, 'Absolute Eosinophil Count', '135.00', 5, 3),
(157262, 157261, 7, 'Albumin', '100.00', 5, 3),
(157263, 157261, 12, 'Amylase', '350.00', 5, 3),
(157264, 157262, 3, 'Absolute Lymphocyte Count', '150.00', 5, 3),
(157265, 157262, 12, 'Amylase', '350.00', 5, 3),
(157266, 157262, 367, 'ANCA', '1600.00', 0, 3),
(157267, 157263, 3, 'Absolute Lymphocyte Count', '150.00', 5, 3),
(157271, 157271, 203, 'Urine Culture And Sensitivity', '430.00', 5, 5),
(157272, 157271, 209, 'Urine RE', '130.00', 5, 5),
(157273, 157271, 174, 'Thyroid Stimulating Hormone', '260.00', 5, 5),
(157274, 157272, 167, 'Sugar (Fasting)', '100.00', 5, 5),
(157275, 157272, 168, 'Sugar (PP)', '100.00', 5, 5),
(157276, 157272, 46, 'Complete Haemogram', '400.00', 5, 5),
(157277, 157273, 46, 'Complete Haemogram', '400.00', 5, 5),
(157278, 157273, 173, 'THYROID FUNCTION TEST', '650.00', 5, 5),
(157279, 157274, 159, 'SGOT / AST', '130.00', 5, 5),
(157281, 157281, 107, 'LIVER FUNCTION TEST', '650.00', 5, 5),
(157291, 157291, 167, 'Sugar (Fasting)', '100.00', 5, 5),
(157292, 157291, 168, 'Sugar (PP)', '100.00', 5, 5),
(157293, 157292, 160, 'SGPT / ALT', '130.00', 5, 5),
(157294, 157293, 160, 'SGPT / ALT', '130.00', 5, 5),
(157301, 157301, 169, 'Sugar (Random)', '100.00', 5, 5),
(157302, 157301, 85, 'HBsAg', '280.00', 5, 5),
(157303, 157301, 89, 'Hepatitis C ', '450.00', 5, 5),
(157304, 157301, 212, 'VDRL / RPR', '150.00', 5, 5),
(157305, 157301, 92, 'HIV / R - Antibody', '450.00', 5, 5),
(157306, 157301, 69, 'Free - T4', '350.00', 5, 5),
(157307, 157301, 174, 'Thyroid Stimulating Hormone', '260.00', 5, 5),
(157308, 157301, 209, 'Urine RE', '130.00', 5, 5),
(157309, 157301, 28, 'Blood Grouping', '90.00', 5, 5),
(157311, 157311, 46, 'Complete Haemogram', '400.00', 5, 5),
(157312, 157311, 169, 'Sugar (Random)', '100.00', 5, 5),
(157313, 157311, 212, 'VDRL / RPR', '150.00', 5, 5),
(157314, 157311, 209, 'Urine RE', '130.00', 5, 5),
(157315, 157311, 85, 'HBsAg', '280.00', 5, 5),
(157316, 157311, 89, 'Hepatitis C ', '450.00', 5, 5),
(157317, 157311, 92, 'HIV / R - Antibody', '450.00', 5, 5),
(157318, 157311, 28, 'Blood Grouping', '90.00', 5, 5),
(157319, 157311, 387, 'Bleeding Time, Clotting Time', '120.00', 5, 5),
(158101, 158101, 84, 'Haemoglobin', '80.00', 5, 5),
(158102, 158101, 28, 'Blood Grouping', '90.00', 5, 5),
(158103, 158101, 209, 'Urine RE', '130.00', 5, 5),
(158104, 158101, 169, 'Sugar (Random)', '100.00', 5, 5),
(158105, 158101, 174, 'Thyroid Stimulating Hormone', '260.00', 5, 5),
(158106, 158101, 69, 'Free - T4', '350.00', 5, 5),
(158107, 158101, 85, 'HBsAg', '280.00', 5, 5),
(158108, 158101, 89, 'Hepatitis C ', '450.00', 5, 5),
(158109, 158102, 168, 'Sugar (PP)', '100.00', 5, 5),
(158111, 158111, 167, 'Sugar (Fasting)', '100.00', 5, 5),
(158112, 158111, 209, 'Urine RE', '130.00', 5, 5),
(158113, 158112, 107, 'LIVER FUNCTION TEST', '650.00', 5, 5),
(158114, 158112, 102, 'KIDNEY FUNCTION TEST/RENAL FUNCTION TEST', '580.00', 5, 5),
(158115, 158112, 29, 'Blood RE', '300.00', 5, 5),
(158121, 158121, 46, 'Complete Haemogram', '400.00', 5, 5),
(158131, 158131, 169, 'Sugar (Random)', '100.00', 5, 5),
(158132, 158132, 107, 'LIVER FUNCTION TEST', '650.00', 5, 5),
(158133, 158132, 102, 'KIDNEY FUNCTION TEST/RENAL FUNCTION TEST', '580.00', 5, 5),
(158134, 158132, 46, 'Complete Haemogram', '400.00', 5, 5),
(158135, 158133, 46, 'Complete Haemogram', '400.00', 5, 5),
(158136, 158133, 169, 'Sugar (Random)', '100.00', 5, 5),
(158137, 158133, 110, 'Lipid Profile', '700.00', 5, 5),
(158138, 158133, 174, 'Thyroid Stimulating Hormone', '260.00', 5, 5),
(158141, 158141, 167, 'Sugar (Fasting)', '100.00', 5, 5),
(158142, 158141, 168, 'Sugar (PP)', '100.00', 5, 5),
(158143, 158142, 168, 'Sugar (PP)', '100.00', 5, 5),
(158144, 158143, 167, 'Sugar (Fasting)', '100.00', 5, 5),
(158145, 158143, 168, 'Sugar (PP)', '100.00', 5, 5),
(158151, 158151, 160, 'SGPT / ALT', '130.00', 5, 5),
(158152, 158151, 159, 'SGOT / AST', '130.00', 5, 5),
(158153, 158151, 37, 'Cholesterol', '200.00', 5, 5),
(158154, 158151, 53, 'Creatinine', '120.00', 5, 5),
(158155, 158151, 167, 'Sugar (Fasting)', '100.00', 5, 5),
(158156, 158151, 168, 'Sugar (PP)', '100.00', 5, 5),
(158157, 158151, 182, 'Triglyceride', '200.00', 5, 5),
(158181, 158181, 174, 'Thyroid Stimulating Hormone', '260.00', 5, 5),
(158182, 158181, 169, 'Sugar (Random)', '100.00', 5, 5),
(158183, 158181, 110, 'Lipid Profile', '700.00', 5, 5),
(158184, 158181, 46, 'Complete Haemogram', '400.00', 5, 5),
(158185, 158182, 28, 'Blood Grouping', '90.00', 5, 5),
(158186, 158183, 169, 'Sugar (Random)', '100.00', 5, 5),
(158187, 158184, 102, 'KIDNEY FUNCTION TEST/RENAL FUNCTION TEST', '580.00', 5, 5),
(158188, 158184, 187, 'Uric Acid', '150.00', 5, 5),
(158189, 158184, 167, 'Sugar (Fasting)', '100.00', 5, 5),
(158201, 158201, 102, 'KIDNEY FUNCTION TEST/RENAL FUNCTION TEST', '580.00', 5, 5),
(158202, 158201, 169, 'Sugar (Random)', '100.00', 5, 5),
(158203, 158201, 46, 'Complete Haemogram', '400.00', 5, 5),
(158204, 158202, 107, 'LIVER FUNCTION TEST', '650.00', 5, 5),
(158205, 158202, 110, 'Lipid Profile', '700.00', 5, 5),
(158206, 158202, 187, 'Uric Acid', '150.00', 5, 5),
(158207, 158203, 46, 'Complete Haemogram', '400.00', 5, 5),
(158208, 158204, 53, 'Creatinine', '120.00', 5, 5),
(158209, 158204, 37, 'Cholesterol', '200.00', 5, 5),
(158211, 158211, 37, 'Cholesterol', '200.00', 5, 5),
(158212, 158211, 53, 'Creatinine', '120.00', 5, 5),
(158214, 158211, 169, 'Sugar (Random)', '100.00', 5, 5),
(158215, 158211, 29, 'Blood RE', '300.00', 5, 5),
(158216, 158205, 46, 'Complete Haemogram', '400.00', 5, 5),
(158217, 158212, 46, 'Complete Haemogram', '400.00', 5, 5),
(158218, 158211, 182, 'Triglyceride', '200.00', 5, 5),
(158219, 158213, 169, 'Sugar (Random)', '100.00', 5, 5),
(158221, 158221, 46, 'Complete Haemogram', '400.00', 5, 5),
(158222, 158221, 386, 'Typhidot / Enteriocheck', '350.00', 5, 5),
(158223, 158221, 209, 'Urine RE', '130.00', 5, 5),
(158251, 158251, 169, 'Sugar (Random)', '100.00', 5, 5),
(158252, 158252, 46, 'Complete Haemogram', '400.00', 5, 5),
(158253, 158252, 169, 'Sugar (Random)', '100.00', 5, 5),
(158254, 158252, 187, 'Uric Acid', '150.00', 5, 5),
(158255, 158253, 46, 'Complete Haemogram', '400.00', 5, 5),
(158256, 158253, 107, 'LIVER FUNCTION TEST', '650.00', 5, 5),
(158257, 158254, 187, 'Uric Acid', '150.00', 5, 5),
(158271, 158271, 167, 'Sugar (Fasting)', '100.00', 5, 5),
(158272, 158271, 168, 'Sugar (PP)', '100.00', 5, 5),
(158273, 158271, 37, 'Cholesterol', '200.00', 5, 5),
(158274, 158271, 53, 'Creatinine', '120.00', 5, 5),
(158291, 158291, 174, 'Thyroid Stimulating Hormone', '260.00', 5, 5),
(158292, 158291, 171, 'T3', '260.00', 5, 5),
(158293, 158291, 172, 'T4', '260.00', 5, 5),
(158294, 158291, 169, 'Sugar (Random)', '100.00', 5, 5),
(158295, 158291, 110, 'Lipid Profile', '700.00', 5, 5),
(158296, 158292, 46, 'Complete Haemogram', '400.00', 5, 5),
(158301, 158301, 46, 'Complete Haemogram', '400.00', 5, 5),
(158410, 15845, 107, 'LIVER FUNCTION TEST', '650.00', 5, 5),
(158810, 15883, 46, 'Complete Haemogram', '400.00', 5, 5),
(158811, 15884, 46, 'Complete Haemogram', '400.00', 5, 5),
(158812, 15884, 110, 'Lipid Profile', '700.00', 5, 5),
(158813, 15884, 107, 'LIVER FUNCTION TEST', '650.00', 5, 5),
(158814, 15884, 167, 'Sugar (Fasting)', '100.00', 5, 5),
(158815, 15884, 168, 'Sugar (PP)', '100.00', 5, 5),
(158816, 15884, 77, 'Glycosylated (HBA 1C)', '490.00', 5, 5),
(159101, 109151, 167, 'Sugar (Fasting)', '100.00', 5, 5),
(159102, 109152, 28, 'Blood Grouping', '90.00', 5, 5),
(159103, 109153, 28, 'Blood Grouping', '90.00', 5, 5),
(159104, 109154, 28, 'Blood Grouping', '90.00', 5, 5),
(159121, 129151, 140, 'Prolactin', '480.00', 5, 5),
(159122, 129152, 166, 'Stool Culture & Sensitivity', '430.00', 5, 5),
(159123, 129153, 84, 'Haemoglobin', '80.00', 5, 5),
(159124, 129153, 28, 'Blood Grouping', '90.00', 5, 5),
(159125, 129153, 212, 'VDRL / RPR', '150.00', 5, 5),
(159126, 129153, 169, 'Sugar (Random)', '100.00', 5, 5),
(159127, 129153, 209, 'Urine RE', '130.00', 5, 5),
(159129, 129155, 28, 'Blood Grouping', '90.00', 5, 5),
(159410, 49152, 168, 'Sugar (PP)', '100.00', 5, 5),
(159810, 89153, 110, 'Lipid Profile', '700.00', 5, 5),
(159910, 99155, 169, 'Sugar (Random)', '100.00', 5, 5),
(159912, 99155, 173, 'THYROID FUNCTION TEST', '650.00', 5, 5),
(160461, 604161, 102, 'KIDNEY FUNCTION TEST/RENAL FUNCTION TEST', '580.00', 5, 3),
(1509151, 1509151, 110, 'Lipid Profile', '700.00', 5, 5),
(1509161, 1609151, 112, 'Malarial Parasite (OMT)', '350.00', 5, 5),
(1509181, 1809151, 46, 'Complete Haemogram', '400.00', 5, 5),
(1509211, 2109151, 167, 'Sugar (Fasting)', '100.00', 5, 5),
(1509212, 2109152, 167, 'Sugar (Fasting)', '100.00', 5, 5),
(1509213, 2109153, 46, 'Complete Haemogram', '400.00', 5, 5),
(1509222, 2209152, 28, 'Blood Grouping', '90.00', 5, 5),
(1509223, 2209152, 203, 'Urine Culture And Sensitivity', '430.00', 5, 5),
(1509224, 2209152, 46, 'Complete Haemogram', '400.00', 5, 5),
(1509225, 2209152, 107, 'LIVER FUNCTION TEST', '650.00', 5, 5),
(1509226, 2209153, 102, 'KIDNEY FUNCTION TEST/RENAL FUNCTION TEST', '580.00', 5, 5),
(1509227, 2209153, 107, 'LIVER FUNCTION TEST', '650.00', 5, 5),
(1509228, 2209154, 110, 'Lipid Profile', '700.00', 5, 5),
(1509231, 2309151, 107, 'LIVER FUNCTION TEST', '650.00', 5, 5),
(1509232, 2309151, 102, 'KIDNEY FUNCTION TEST/RENAL FUNCTION TEST', '580.00', 5, 5),
(1509233, 2309151, 110, 'Lipid Profile', '700.00', 5, 5),
(1509234, 2309152, 173, 'THYROID FUNCTION TEST', '650.00', 5, 5),
(1509235, 2309152, 169, 'Sugar (Random)', '100.00', 5, 5),
(1509236, 2309152, 46, 'Complete Haemogram', '400.00', 5, 5),
(1509237, 2309153, 92, 'HIV / R - Antibody', '450.00', 5, 5),
(1509238, 2309154, 46, 'Complete Haemogram', '400.00', 5, 5),
(1509251, 2509151, 110, 'Lipid Profile', '700.00', 5, 5),
(1509252, 2509151, 174, 'Thyroid Stimulating Hormone', '260.00', 5, 5),
(1509253, 2509152, 53, 'Creatinine', '120.00', 5, 5),
(1509271, 2709151, 29, 'Blood RE', '300.00', 5, 5),
(1509272, 2709152, 167, 'Sugar (Fasting)', '100.00', 5, 5),
(1509273, 2709152, 168, 'Sugar (PP)', '100.00', 5, 5),
(1509274, 2709152, 182, 'Triglyceride', '200.00', 5, 5),
(1509291, 2909151, 46, 'Complete Haemogram', '400.00', 5, 1),
(1509292, 2909151, 174, 'Thyroid Stimulating Hormone', '260.00', 5, 1),
(1509293, 2909152, 102, 'KIDNEY FUNCTION TEST/RENAL FUNCTION TEST', '580.00', 5, 5),
(1509294, 2909152, 107, 'LIVER FUNCTION TEST', '650.00', 5, 5),
(1509295, 2909152, 169, 'Sugar (Random)', '100.00', 5, 5),
(1509296, 2909152, 46, 'Complete Haemogram', '400.00', 5, 5),
(1509297, 2909153, 386, 'Typhidot / Enteriocheck', '350.00', 5, 5),
(1572710, 157274, 160, 'SGPT / ALT', '130.00', 5, 5),
(1572712, 157274, 29, 'Blood RE', '300.00', 5, 5),
(1572713, 157275, 187, 'Uric Acid', '150.00', 5, 5),
(1572714, 157274, 53, 'Creatinine', '120.00', 5, 5),
(1573010, 157301, 46, 'Complete Haemogram', '400.00', 5, 5),
(1573011, 157302, 107, 'LIVER FUNCTION TEST', '650.00', 5, 5),
(1573012, 157303, 174, 'Thyroid Stimulating Hormone', '260.00', 5, 5),
(1573013, 157304, 37, 'Cholesterol', '200.00', 5, 5),
(1573014, 157304, 182, 'Triglyceride', '200.00', 5, 5),
(1573015, 157305, 28, 'Blood Grouping', '90.00', 5, 5),
(1573016, 157306, 167, 'Sugar (Fasting)', '100.00', 5, 5),
(1573017, 157307, 167, 'Sugar (Fasting)', '100.00', 5, 5),
(1573018, 157308, 28, 'Blood Grouping', '90.00', 5, 5),
(1573019, 157309, 168, 'Sugar (PP)', '100.00', 5, 5),
(1573020, 1573010, 169, 'Sugar (Random)', '100.00', 5, 5),
(1573021, 1573011, 169, 'Sugar (Random)', '100.00', 5, 5),
(1573022, 1573012, 84, 'Haemoglobin', '80.00', 5, 5),
(1573023, 1573013, 174, 'Thyroid Stimulating Hormone', '260.00', 5, 5),
(1573024, 1573014, 167, 'Sugar (Fasting)', '100.00', 5, 5),
(1573025, 1573014, 168, 'Sugar (PP)', '100.00', 5, 5),
(1573026, 1573015, 107, 'LIVER FUNCTION TEST', '650.00', 5, 5),
(1573027, 1573016, 46, 'Complete Haemogram', '400.00', 5, 5),
(1573028, 1573016, 102, 'KIDNEY FUNCTION TEST/RENAL FUNCTION TEST', '580.00', 5, 5),
(1573029, 1573016, 107, 'LIVER FUNCTION TEST', '650.00', 5, 5),
(1573030, 1573017, 386, 'Typhidot / Enteriocheck', '350.00', 5, 5),
(1573031, 1573017, 107, 'LIVER FUNCTION TEST', '650.00', 5, 5),
(1573032, 1573017, 102, 'KIDNEY FUNCTION TEST/RENAL FUNCTION TEST', '580.00', 5, 5),
(1573033, 1573017, 142, 'Prothrombin Time', '280.00', 5, 5),
(1573034, 1573018, 84, 'Haemoglobin', '80.00', 5, 5),
(1573035, 1573018, 160, 'SGPT / ALT', '130.00', 5, 5),
(1573036, 1573019, 102, 'KIDNEY FUNCTION TEST/RENAL FUNCTION TEST', '580.00', 5, 5),
(1573037, 1573020, 169, 'Sugar (Random)', '100.00', 5, 5),
(1573038, 1573021, 167, 'Sugar (Fasting)', '100.00', 5, 5),
(1573039, 1573021, 168, 'Sugar (PP)', '100.00', 5, 5),
(1573040, 1573022, 167, 'Sugar (Fasting)', '100.00', 5, 5),
(1573041, 1573023, 110, 'Lipid Profile', '700.00', 5, 5),
(1573042, 1573023, 209, 'Urine RE', '130.00', 5, 5),
(1573043, 1573024, 187, 'Uric Acid', '150.00', 5, 5),
(1573044, 1573025, 107, 'LIVER FUNCTION TEST', '650.00', 5, 5),
(1573045, 1573026, 169, 'Sugar (Random)', '100.00', 5, 5),
(1573046, 157307, 168, 'Sugar (PP)', '100.00', 5, 5),
(1573047, 1573027, 46, 'Complete Haemogram', '400.00', 5, 5),
(1573048, 1573027, 174, 'Thyroid Stimulating Hormone', '260.00', 5, 5),
(1573049, 1573028, 46, 'Complete Haemogram', '400.00', 5, 5),
(1573050, 1573028, 102, 'KIDNEY FUNCTION TEST/RENAL FUNCTION TEST', '580.00', 5, 5),
(1573051, 1573028, 107, 'LIVER FUNCTION TEST', '650.00', 5, 5),
(1581010, 158103, 167, 'Sugar (Fasting)', '100.00', 5, 5),
(1581011, 158103, 168, 'Sugar (PP)', '100.00', 5, 5),
(1581012, 158104, 174, 'Thyroid Stimulating Hormone', '260.00', 5, 5),
(1581013, 158104, 163, 'Sputum AFB', '150.00', 5, 5),
(1581810, 158184, 168, 'Sugar (PP)', '100.00', 5, 5),
(1582010, 158204, 182, 'Triglyceride', '200.00', 5, 5),
(1582011, 158205, 386, 'Typhidot / Enteriocheck', '350.00', 5, 5),
(1582012, 158205, 112, 'Malarial Parasite (OMT)', '350.00', 5, 5),
(1582110, 158213, 174, 'Thyroid Stimulating Hormone', '260.00', 5, 5),
(1582111, 158213, 209, 'Urine RE', '130.00', 5, 5),
(1582112, 158213, 203, 'Urine Culture And Sensitivity', '430.00', 5, 5),
(1582113, 158214, 169, 'Sugar (Random)', '100.00', 5, 5),
(1582114, 158214, 171, 'T3', '260.00', 5, 5),
(1582115, 158214, 172, 'T4', '260.00', 5, 5),
(1582116, 158214, 174, 'Thyroid Stimulating Hormone', '260.00', 5, 5),
(1582117, 158214, 110, 'Lipid Profile', '700.00', 5, 5),
(1591210, 129156, 28, 'Blood Grouping', '90.00', 5, 5),
(1591211, 129157, 174, 'Thyroid Stimulating Hormone', '260.00', 5, 5),
(1591212, 129157, 84, 'Haemoglobin', '80.00', 5, 5),
(1603281, 2803161, 28, 'Blood Grouping', '90.00', 5, 1),
(1603282, 2803162, 102, 'KIDNEY FUNCTION TEST/RENAL FUNCTION TEST', '580.00', 5, 1),
(1603283, 2803163, 502, 'Acid Phosphatase', '350.00', 5, 1),
(1603291, 2903161, 107, 'LIVER FUNCTION TEST', '650.00', 5, 1),
(1603292, 2903161, 336, 'X - Ray Styloid Process', '270.00', 8, 1),
(1603293, 2903162, 102, 'KIDNEY FUNCTION TEST/RENAL FUNCTION TEST', '580.00', 5, 1),
(1603294, 2903162, 107, 'LIVER FUNCTION TEST', '650.00', 5, 1),
(1603295, 2903162, 187, 'Uric Acid', '150.00', 5, 1),
(2209151, 2209151, 168, 'Sugar (PP)', '100.00', 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `patient_transaction`
--

CREATE TABLE IF NOT EXISTS `patient_transaction` (
  `TR_id` int(10) unsigned NOT NULL,
  `TR_pp_sl` int(10) unsigned NOT NULL,
  `TR_amount` decimal(8,2) NOT NULL,
  `TR_date` datetime NOT NULL,
  `TR_user` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `patient_transaction`
--

INSERT INTO `patient_transaction` (`TR_id`, `TR_pp_sl`, `TR_amount`, `TR_date`, `TR_user`) VALUES
(15811, 15811, '0.00', '2015-08-01 07:33:48', 158),
(15812, 15812, '100.00', '2015-08-01 08:08:41', 158),
(15813, 15812, '90.00', '2015-08-01 14:18:00', 1510),
(15814, 15813, '0.00', '2015-08-01 16:06:41', 1510),
(15815, 15814, '0.00', '2015-08-01 16:11:15', 1510),
(15831, 15831, '0.00', '2015-08-03 06:46:17', 158),
(15832, 15832, '200.00', '2015-08-03 13:31:04', 1510),
(15833, 15831, '500.00', '2015-08-03 15:21:10', 158),
(15841, 15841, '200.00', '2015-08-04 08:29:01', 158),
(15842, 15842, '90.00', '2015-08-04 09:39:09', 158),
(15843, 15843, '90.00', '2015-08-04 10:25:04', 158),
(15844, 15844, '1630.00', '2015-08-04 14:16:41', 1510),
(15845, 15845, '0.00', '2015-08-04 14:28:57', 1510),
(15846, 15845, '1630.00', '2015-08-04 17:00:01', 1510),
(15847, 15831, '250.00', '2015-08-04 17:45:34', 1510),
(15861, 15811, '180.00', '2015-08-06 07:47:04', 158),
(15862, 157307, '100.00', '2015-08-06 07:59:05', 158),
(15881, 15881, '1740.00', '2015-07-06 12:04:00', 158),
(15882, 15882, '400.00', '2015-08-08 15:44:58', 1510),
(15883, 15883, '400.00', '2015-08-08 15:59:35', 1510),
(15884, 15884, '2440.00', '2015-08-08 16:03:55', 1510),
(15891, 15891, '80.00', '2015-08-09 17:07:27', 1510),
(15911, 15911, '1100.00', '2015-08-31 14:14:00', 158),
(15912, 158221, '880.00', '2015-09-01 14:27:35', 2),
(15913, 15912, '200.00', '2015-08-31 15:23:00', 158),
(15914, 15913, '150.00', '2015-08-31 15:24:00', 158),
(15915, 15871, '490.00', '2015-09-01 16:30:58', 2),
(15931, 15931, '0.00', '2015-09-03 10:39:23', 1510),
(15932, 15932, '0.00', '2015-09-03 10:42:53', 1510),
(15934, 15934, '400.00', '2015-09-03 17:33:27', 1510),
(15937, 15933, '730.00', '2015-09-03 17:41:11', 2),
(15938, 15935, '100.00', '2015-09-03 17:46:15', 158),
(15939, 15936, '180.00', '2015-09-03 17:48:24', 158),
(15941, 157301, '1550.00', '2015-09-04 12:55:43', 2),
(15943, 15942, '1650.00', '2015-09-04 13:58:25', 1510),
(15982, 15971, '80.00', '2015-09-08 10:44:10', 2),
(15985, 15982, '400.00', '2015-09-08 12:51:01', 1510),
(15987, 15983, '800.00', '2015-09-08 17:11:43', 1510),
(15991, 15991, '200.00', '2015-09-09 11:32:18', 1510),
(15992, 15992, '900.00', '2015-09-09 11:40:19', 1510),
(15993, 15993, '800.00', '2015-09-09 12:35:48', 1510),
(15994, 15994, '200.00', '2015-09-09 12:37:58', 1510),
(15996, 15995, '750.00', '2015-09-09 12:51:43', 2),
(110151, 110151, '0.00', '2015-09-28 09:09:00', 158),
(110152, 110152, '0.00', '2015-09-22 09:08:00', 158),
(110153, 110153, '0.00', '2015-10-01 16:34:01', 1510),
(110154, 110154, '0.00', '2015-10-01 16:39:08', 1510),
(110155, 110155, '0.00', '2015-10-01 16:56:26', 1510),
(157261, 157261, '400.00', '2015-07-26 14:21:47', 157),
(157262, 157262, '1000.00', '2015-07-26 14:24:55', 157),
(157263, 157261, '85.00', '2015-07-26 14:26:47', 157),
(157264, 157263, '100.00', '2015-07-26 14:28:19', 157),
(157271, 157271, '820.00', '2015-07-27 12:29:43', 158),
(157272, 157272, '600.00', '2015-07-27 12:45:20', 1510),
(157273, 157273, '0.00', '2015-07-26 14:40:00', 158),
(157281, 157281, '650.00', '2015-07-28 12:28:58', 1510),
(157291, 157291, '200.00', '2015-07-29 10:57:14', 1510),
(157292, 157292, '130.00', '2015-07-29 11:40:25', 158),
(157293, 157293, '130.00', '2015-07-29 11:44:19', 158),
(157302, 157302, '500.00', '2015-06-25 15:44:00', 1510),
(157303, 157303, '200.00', '2015-06-29 15:47:00', 1510),
(157304, 157304, '340.00', '2015-06-30 15:52:00', 1510),
(157305, 157305, '50.00', '2015-06-30 15:57:00', 1510),
(157306, 157306, '100.00', '2015-07-01 16:00:00', 1510),
(157307, 157307, '90.00', '2015-07-01 16:03:00', 1510),
(157308, 157308, '90.00', '2015-07-02 16:05:00', 1510),
(157309, 157309, '80.00', '2015-07-02 16:07:00', 1510),
(157311, 157311, '0.00', '2015-07-31 11:45:28', 157),
(157312, 157311, '2100.00', '2015-07-31 18:11:01', 157),
(158101, 158101, '0.00', '2015-08-10 11:43:11', 1510),
(158102, 158102, '100.00', '2015-08-10 12:23:47', 1510),
(158103, 158103, '100.00', '2015-08-09 16:46:00', 1510),
(158104, 158104, '0.00', '2015-08-09 17:59:00', 158),
(158111, 158111, '230.00', '2015-08-11 07:49:27', 158),
(158112, 158103, '100.00', '2015-08-11 10:19:21', 158),
(158113, 158112, '1230.00', '2015-08-11 11:51:44', 1510),
(158114, 158112, '300.00', '2015-08-11 14:52:49', 1510),
(158121, 158121, '0.00', '2015-08-12 17:46:12', 1510),
(158131, 158131, '100.00', '2015-08-13 08:01:06', 158),
(158132, 158132, '0.00', '2015-08-13 11:04:35', 158),
(158133, 158133, '1460.00', '2015-08-13 16:56:58', 1510),
(158134, 158104, '410.00', '2015-08-13 18:45:45', 1510),
(158141, 158141, '100.00', '2015-08-14 11:33:31', 1510),
(158142, 158142, '100.00', '2015-08-14 13:42:49', 1510),
(158143, 158143, '200.00', '2015-08-14 14:03:56', 1510),
(158151, 158151, '0.00', '2015-08-15 10:55:17', 1510),
(158171, 158101, '1740.00', '2015-08-17 08:11:21', 158),
(158181, 158181, '1460.00', '2015-08-18 09:59:11', 1510),
(158182, 158182, '90.00', '2015-08-18 10:02:40', 1510),
(158183, 158183, '100.00', '2015-08-18 10:04:09', 1510),
(158184, 158184, '0.00', '2015-08-18 11:29:16', 1510),
(158185, 158184, '930.00', '2015-08-18 16:31:52', 158),
(158191, 158151, '780.00', '2015-08-19 11:15:32', 158),
(158192, 158181, '438.00', '2015-08-19 11:16:01', 158),
(158193, 158182, '27.00', '2015-08-19 11:16:09', 158),
(158194, 158183, '30.00', '2015-08-19 11:16:18', 158),
(158201, 158201, '1080.00', '2015-08-20 08:38:47', 158),
(158203, 158203, '0.00', '2015-08-20 09:44:30', 1510),
(158204, 158204, '0.00', '2015-08-20 09:47:46', 1510),
(158205, 158205, '0.00', '2015-08-20 18:00:32', 1510),
(158211, 158211, '800.00', '2015-08-21 09:13:22', 158),
(158213, 158211, '80.00', '2015-08-21 13:59:52', 158),
(158214, 158213, '0.00', '2015-08-21 17:25:27', 1510),
(158215, 158214, '100.00', '2015-08-21 17:31:54', 1510),
(158222, 158205, '1100.00', '2015-08-22 12:24:09', 1510),
(158242, 157274, '0.00', '2015-08-24 15:06:33', 2),
(158243, 157275, '0.00', '2015-08-24 15:07:03', 2),
(158244, 1573023, '0.00', '2015-08-24 15:07:46', 2),
(158245, 1573025, '0.00', '2015-08-24 15:08:41', 2),
(158246, 1573027, '0.00', '2015-08-24 15:09:08', 2),
(158247, 1573028, '0.00', '2015-08-24 15:09:35', 2),
(158248, 158202, '1500.00', '2015-08-24 15:28:50', 2),
(158251, 158212, '400.00', '2015-08-25 09:09:35', 2),
(158252, 158251, '0.00', '2015-08-25 09:18:02', 158),
(158253, 158252, '0.00', '2015-08-25 09:23:23', 158),
(158254, 158253, '1050.00', '2015-08-25 10:49:20', 158),
(158255, 158254, '150.00', '2015-08-25 11:04:31', 158),
(158271, 158271, '0.00', '2015-08-27 15:58:45', 1510),
(158292, 158291, '1580.00', '2015-08-29 13:26:50', 2),
(158293, 158292, '0.00', '2015-08-29 17:45:51', 1510),
(158301, 158301, '400.00', '2015-08-30 09:06:22', 158),
(159101, 159101, '100.00', '2015-09-10 16:01:15', 158),
(159102, 159102, '90.00', '2015-09-10 16:03:24', 158),
(159103, 159103, '90.00', '2015-09-10 16:04:54', 158),
(159104, 159104, '90.00', '2015-09-10 16:06:33', 158),
(159121, 159121, '480.00', '2015-09-11 10:24:00', 158),
(159122, 159122, '430.00', '2015-09-08 08:12:00', 158),
(159123, 159123, '550.00', '2015-09-12 08:39:56', 158),
(159125, 159125, '90.00', '2015-09-12 17:14:11', 1510),
(159126, 159126, '90.00', '2015-09-12 17:16:59', 1510),
(159127, 159127, '340.00', '2015-09-12 17:19:43', 1510),
(159214, 159124, '0.00', '2015-09-21 16:34:56', 2),
(159237, 15941, '650.00', '2015-09-23 17:54:13', 2),
(210151, 210151, '260.00', '2015-09-29 16:56:00', 158),
(210152, 210152, '0.00', '2015-10-02 10:23:23', 1510),
(210153, 210153, '0.00', '2015-10-02 12:48:29', 1510),
(1509151, 1509151, '0.00', '2015-09-15 10:33:30', 1510),
(1573010, 1573010, '90.00', '2015-07-03 16:09:00', 1510),
(1573011, 1573011, '90.00', '2015-07-03 16:11:00', 1510),
(1573012, 1573012, '80.00', '2015-07-05 16:13:00', 1510),
(1573013, 1573013, '250.00', '2015-07-07 16:15:00', 1510),
(1573014, 1573014, '200.00', '2015-07-10 16:18:00', 1510),
(1573015, 1573015, '650.00', '2015-07-10 16:20:00', 1510),
(1573016, 1573016, '1630.00', '2015-07-10 16:24:00', 1510),
(1573017, 1573017, '1860.00', '2015-07-11 16:29:00', 1510),
(1573018, 1573018, '200.00', '2015-07-13 16:32:00', 1510),
(1573019, 1573019, '580.00', '2015-07-13 16:35:00', 1510),
(1573020, 1573020, '100.00', '2015-07-13 16:37:00', 1510),
(1573021, 1573021, '190.00', '2015-07-15 16:39:00', 1510),
(1573022, 1573022, '90.00', '2015-07-15 16:42:00', 1510),
(1573024, 1573024, '150.00', '2015-07-19 16:51:00', 1510),
(1573026, 1573026, '0.00', '2015-07-24 17:03:00', 1510),
(1609151, 1609151, '350.00', '2015-09-16 15:35:26', 1510),
(1709151, 15981, '2570.00', '2015-09-17 10:51:57', 2),
(1809151, 1809151, '400.00', '2015-09-18 08:14:53', 158),
(2109151, 2109151, '100.00', '2015-09-21 10:08:23', 158),
(2109153, 2109153, '0.00', '2015-09-21 15:09:24', 158),
(2209151, 2209151, '100.00', '2015-09-22 11:03:18', 158),
(2209152, 2209152, '0.00', '2015-09-22 11:48:37', 158),
(2209153, 2209153, '0.00', '2015-09-22 11:50:33', 158),
(2209154, 2209154, '0.00', '2015-09-22 11:52:30', 158),
(2209155, 2109152, '0.00', '2015-09-22 16:49:38', 2),
(2309152, 2309152, '1150.00', '2015-09-23 10:00:30', 1510),
(2309153, 2309153, '450.00', '2015-09-23 10:03:35', 1510),
(2309155, 2309154, '400.00', '2015-09-23 15:47:54', 158),
(2509151, 2509151, '960.00', '2015-09-25 10:21:21', 1510),
(2509152, 2509152, '120.00', '2015-09-25 13:21:08', 1510),
(2509154, 2309151, '1930.00', '2015-09-25 15:18:38', 2),
(2709155, 2709152, '400.00', '2015-09-27 14:30:36', 2),
(2803161, 2803161, '90.00', '2016-03-28 14:26:51', 158),
(2803162, 2803162, '580.00', '2016-03-28 21:51:14', 1614),
(2803163, 2803163, '350.00', '2016-03-28 21:58:31', 1614),
(2903161, 2903161, '920.00', '2016-03-29 11:19:44', 1614),
(2903162, 2903162, '1380.00', '2016-03-29 22:28:29', 1614),
(2909151, 2709151, '300.00', '2015-09-29 09:22:07', 2),
(2909152, 2909151, '660.00', '2015-09-29 09:33:21', 158),
(2909153, 2909152, '1730.00', '2015-09-29 13:17:16', 1510),
(2909154, 2909153, '350.00', '2015-09-29 17:24:16', 1510);

-- --------------------------------------------------------

--
-- Table structure for table `pin_tbl`
--

CREATE TABLE IF NOT EXISTS `pin_tbl` (
  `pin_id` int(10) NOT NULL,
  `pin_code` int(6) NOT NULL,
  `district_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `price_dump`
--

CREATE TABLE IF NOT EXISTS `price_dump` (
  `PD_sl` int(10) unsigned NOT NULL,
  `PD_test_id` int(10) unsigned NOT NULL,
  `PD_price` decimal(8,2) NOT NULL,
  `PD_version` smallint(5) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `price_dump`
--

INSERT INTO `price_dump` (`PD_sl`, `PD_test_id`, `PD_price`, `PD_version`) VALUES
(1, 1, '120.00', 151),
(2, 2, '1700.00', 151),
(3, 3, '120.00', 151),
(4, 4, '120.00', 151),
(5, 5, '490.00', 151),
(6, 6, '750.00', 151),
(7, 7, '90.00', 151),
(8, 8, '350.00', 151),
(9, 9, '130.00', 151),
(10, 10, '100.00', 151),
(11, 12, '330.00', 151),
(12, 13, '1910.00', 151),
(13, 14, '770.00', 151),
(14, 15, '1450.00', 151),
(15, 16, '1050.00', 151),
(16, 17, '820.00', 151),
(17, 18, '1700.00', 151),
(18, 20, '330.00', 151),
(19, 22, '480.00', 151),
(20, 23, '550.00', 151),
(21, 24, '80.00', 151),
(22, 25, '80.00', 151),
(23, 26, '200.00', 151),
(24, 27, '50.00', 151),
(25, 28, '90.00', 151),
(26, 29, '280.00', 151),
(27, 30, '60.00', 151),
(28, 31, '65.00', 151),
(29, 32, '900.00', 151),
(30, 33, '140.00', 151),
(31, 34, '430.00', 151),
(32, 35, '600.00', 151),
(33, 36, '120.00', 151),
(34, 37, '200.00', 151),
(35, 38, '250.00', 151),
(36, 39, '300.00', 151),
(37, 40, '80.00', 151),
(38, 41, '750.00', 151),
(39, 42, '350.00', 151),
(40, 43, '350.00', 151),
(41, 44, '500.00', 151),
(42, 45, '110.00', 151),
(43, 46, '380.00', 151),
(44, 47, '200.00', 151),
(45, 48, '200.00', 151),
(46, 49, '250.00', 151),
(47, 50, '330.00', 151),
(48, 51, '300.00', 151),
(49, 52, '60.00', 151),
(50, 53, '110.00', 151),
(51, 54, '380.00', 151),
(52, 55, '90.00', 151),
(53, 56, '50.00', 151),
(54, 57, '100.00', 151),
(55, 58, '200.00', 151),
(56, 60, '300.00', 151),
(57, 61, '90.00', 151),
(58, 62, '700.00', 151),
(59, 63, '690.00', 151),
(60, 64, '520.00', 151),
(61, 65, '350.00', 151),
(62, 66, '350.00', 151),
(63, 67, '770.00', 151),
(64, 68, '330.00', 151),
(65, 69, '330.00', 151),
(66, 70, '580.00', 151),
(67, 71, '450.00', 151),
(68, 72, '130.00', 151),
(69, 73, '300.00', 151),
(70, 74, '150.00', 151),
(71, 75, '430.00', 151),
(72, 76, '100.00', 151),
(73, 77, '480.00', 151),
(74, 78, '70.00', 151),
(75, 79, '110.00', 151),
(76, 80, '350.00', 151),
(77, 81, '300.00', 151),
(78, 82, '220.00', 151),
(79, 83, '520.00', 151),
(80, 84, '80.00', 151),
(81, 85, '280.00', 151),
(82, 86, '1350.00', 151),
(83, 87, '800.00', 151),
(84, 88, '800.00', 151),
(85, 89, '420.00', 151),
(86, 90, '240.00', 151),
(87, 91, '550.00', 151),
(88, 92, '450.00', 151),
(89, 93, '1100.00', 151),
(90, 94, '650.00', 151),
(91, 95, '1050.00', 151),
(92, 96, '350.00', 151),
(93, 97, '350.00', 151),
(94, 98, '680.00', 151),
(95, 99, '550.00', 151),
(96, 100, '140.00', 151),
(97, 101, '400.00', 151),
(98, 102, '500.00', 151),
(99, 103, '180.00', 151),
(100, 104, '250.00', 151),
(101, 105, '300.00', 151),
(102, 107, '550.00', 151),
(103, 108, '450.00', 151),
(104, 109, '330.00', 151),
(105, 110, '650.00', 151),
(106, 111, '280.00', 151),
(107, 112, '350.00', 151),
(108, 113, '100.00', 151),
(109, 114, '350.00', 151),
(110, 115, '100.00', 151),
(111, 116, '170.00', 151),
(112, 117, '170.00', 151),
(113, 118, '170.00', 151),
(114, 119, '50.00', 151),
(115, 120, '50.00', 151),
(116, 121, '50.00', 151),
(117, 122, '1100.00', 151),
(118, 123, '500.00', 151),
(119, 124, '110.00', 151),
(120, 125, '90.00', 151),
(121, 126, '100.00', 151),
(122, 127, '330.00', 151),
(123, 128, '80.00', 151),
(124, 129, '250.00', 151),
(125, 130, '430.00', 151),
(126, 131, '300.00', 151),
(127, 132, '60.00', 151),
(128, 133, '90.00', 151),
(129, 134, '330.00', 151),
(130, 135, '250.00', 151),
(131, 136, '300.00', 151),
(132, 137, '300.00', 151),
(133, 138, '110.00', 151),
(134, 139, '110.00', 151),
(135, 140, '450.00', 151),
(136, 141, '120.00', 151),
(137, 142, '250.00', 151),
(138, 143, '660.00', 151),
(139, 144, '660.00', 151),
(140, 145, '90.00', 151),
(141, 146, '380.00', 151),
(142, 148, '90.00', 151),
(143, 149, '20.00', 151),
(144, 150, '150.00', 151),
(145, 151, '350.00', 151),
(146, 152, '350.00', 151),
(147, 154, '350.00', 151),
(148, 155, '350.00', 151),
(149, 156, '380.00', 151),
(150, 157, '700.00', 151),
(151, 158, '220.00', 151),
(152, 159, '110.00', 151),
(153, 160, '110.00', 151),
(154, 161, '300.00', 151),
(155, 162, '130.00', 151),
(156, 163, '150.00', 151),
(157, 164, '380.00', 151),
(158, 165, '120.00', 151),
(159, 166, '380.00', 151),
(160, 167, '100.00', 151),
(161, 168, '100.00', 151),
(162, 169, '100.00', 151),
(163, 170, '300.00', 151),
(164, 171, '260.00', 151),
(165, 172, '260.00', 151),
(166, 173, '650.00', 151),
(167, 174, '260.00', 151),
(168, 175, '380.00', 151),
(169, 176, '2300.00', 151),
(170, 177, '90.00', 151),
(171, 178, '110.00', 151),
(172, 179, '70.00', 151),
(173, 180, '350.00', 151),
(174, 181, '350.00', 151),
(175, 182, '200.00', 151),
(176, 183, '780.00', 151),
(177, 184, '350.00', 151),
(178, 185, '110.00', 151),
(179, 186, '110.00', 151),
(180, 187, '150.00', 151),
(181, 188, '80.00', 151),
(182, 189, '250.00', 151),
(183, 190, '150.00', 151),
(184, 191, '200.00', 151),
(185, 192, '100.00', 151),
(186, 193, '170.00', 151),
(187, 194, '150.00', 151),
(188, 195, '110.00', 151),
(189, 196, '150.00', 151),
(190, 197, '150.00', 151),
(191, 198, '90.00', 151),
(192, 199, '40.00', 151),
(193, 200, '100.00', 151),
(194, 201, '150.00', 151),
(195, 202, '110.00', 151),
(196, 203, '380.00', 151),
(197, 204, '350.00', 151),
(198, 205, '220.00', 151),
(199, 206, '50.00', 151),
(200, 207, '320.00', 151),
(201, 208, '90.00', 151),
(202, 209, '120.00', 151),
(203, 210, '90.00', 151),
(204, 211, '60.00', 151),
(205, 212, '150.00', 151),
(206, 213, '180.00', 151),
(207, 214, '380.00', 151),
(208, 215, '1700.00', 151),
(209, 216, '170.00', 151),
(210, 217, '700.00', 151),
(211, 218, '500.00', 151),
(212, 219, '450.00', 151),
(213, 220, '350.00', 151),
(214, 221, '450.00', 151),
(215, 222, '350.00', 151),
(216, 223, '450.00', 151),
(217, 224, '350.00', 151),
(218, 225, '550.00', 151),
(219, 226, '350.00', 151),
(220, 227, '450.00', 151),
(221, 228, '450.00', 151),
(222, 229, '350.00', 151),
(223, 230, '350.00', 151),
(224, 232, '700.00', 151),
(225, 233, '700.00', 151),
(226, 234, '450.00', 151),
(227, 235, '250.00', 151),
(228, 236, '450.00', 151),
(229, 237, '1150.00', 151),
(230, 238, '1250.00', 151),
(231, 239, '700.00', 151),
(232, 240, '380.00', 151),
(233, 242, '370.00', 151),
(234, 243, '350.00', 151),
(235, 244, '370.00', 151),
(236, 245, '250.00', 151),
(237, 246, '750.00', 151),
(238, 247, '800.00', 151),
(239, 248, '600.00', 151),
(240, 249, '550.00', 151),
(241, 250, '250.00', 151),
(242, 251, '250.00', 151),
(243, 252, '350.00', 151),
(244, 253, '350.00', 151),
(245, 254, '380.00', 151),
(246, 256, '250.00', 151),
(247, 257, '380.00', 151),
(248, 258, '250.00', 151),
(249, 259, '250.00', 151),
(250, 260, '400.00', 151),
(251, 261, '250.00', 151),
(252, 262, '250.00', 151),
(253, 263, '400.00', 151),
(254, 264, '350.00', 151),
(255, 265, '400.00', 151),
(256, 266, '250.00', 151),
(257, 267, '370.00', 151),
(258, 268, '250.00', 151),
(259, 269, '350.00', 151),
(260, 270, '350.00', 151),
(261, 271, '480.00', 151),
(262, 272, '350.00', 151),
(263, 273, '480.00', 151),
(264, 274, '250.00', 151),
(265, 275, '400.00', 151),
(266, 276, '330.00', 151),
(267, 277, '250.00', 151),
(268, 278, '250.00', 151),
(269, 279, '320.00', 151),
(270, 280, '850.00', 151),
(271, 281, '750.00', 151),
(272, 282, '250.00', 151),
(273, 283, '350.00', 151),
(274, 284, '370.00', 151),
(275, 285, '380.00', 151),
(276, 286, '380.00', 151),
(277, 287, '380.00', 151),
(278, 288, '350.00', 151),
(279, 289, '250.00', 151),
(280, 290, '250.00', 151),
(281, 291, '330.00', 151),
(282, 292, '330.00', 151),
(283, 293, '250.00', 151),
(284, 294, '250.00', 151),
(285, 295, '350.00', 151),
(286, 296, '250.00', 151),
(287, 297, '650.00', 151),
(288, 298, '750.00', 151),
(289, 299, '250.00', 151),
(290, 300, '250.00', 151),
(291, 301, '350.00', 151),
(292, 302, '400.00', 151),
(293, 303, '350.00', 151),
(294, 304, '250.00', 151),
(295, 305, '250.00', 151),
(296, 306, '400.00', 151),
(297, 307, '250.00', 151),
(298, 308, '250.00', 151),
(299, 309, '300.00', 151),
(300, 310, '250.00', 151),
(301, 311, '250.00', 151),
(302, 312, '350.00', 151),
(303, 315, '250.00', 151),
(304, 316, '350.00', 151),
(305, 317, '250.00', 151),
(306, 318, '350.00', 151),
(307, 319, '370.00', 151),
(308, 320, '250.00', 151),
(309, 321, '350.00', 151),
(310, 322, '370.00', 151),
(311, 323, '380.00', 151),
(312, 325, '350.00', 151),
(313, 326, '400.00', 151),
(314, 327, '250.00', 151),
(315, 328, '430.00', 151),
(316, 329, '250.00', 151),
(317, 330, '350.00', 151),
(318, 331, '250.00', 151),
(319, 333, '700.00', 151),
(320, 334, '370.00', 151),
(321, 336, '250.00', 151),
(322, 337, '380.00', 151),
(323, 338, '700.00', 151),
(324, 339, '370.00', 151),
(325, 340, '250.00', 151),
(326, 341, '750.00', 151),
(327, 342, '280.00', 151),
(328, 343, '250.00', 151),
(329, 344, '250.00', 151),
(330, 345, '350.00', 151),
(331, 346, '450.00', 151),
(332, 348, '320.00', 151),
(333, 349, '250.00', 151),
(334, 350, '320.00', 151),
(335, 351, '380.00', 151),
(336, 355, '100.00', 151),
(337, 356, '250.00', 151),
(338, 357, '2350.00', 151),
(339, 358, '0.00', 151),
(340, 359, '0.00', 151),
(341, 360, '0.00', 151),
(342, 361, '220.00', 151),
(343, 362, '110.00', 151),
(344, 363, '500.00', 151),
(345, 364, '250.00', 151),
(346, 365, '2500.00', 151),
(347, 366, '825.00', 151),
(348, 367, '1600.00', 151),
(349, 368, '950.00', 151),
(350, 370, '1050.00', 151),
(351, 371, '700.00', 151),
(352, 372, '1550.00', 151),
(353, 374, '900.00', 151),
(354, 376, '1250.00', 151),
(355, 377, '600.00', 151),
(356, 378, '800.00', 151),
(357, 379, '2800.00', 151),
(358, 380, '2800.00', 151),
(359, 382, '220.00', 151),
(360, 383, '380.00', 151),
(361, 384, '250.00', 151),
(362, 385, '450.00', 151),
(363, 386, '350.00', 151),
(364, 387, '120.00', 151),
(365, 388, '380.00', 151),
(366, 389, '800.00', 151),
(367, 390, '50.00', 151),
(368, 391, '100.00', 151),
(369, 392, '700.00', 151),
(370, 393, '450.00', 151),
(371, 394, '1700.00', 151),
(372, 395, '700.00', 151),
(373, 396, '1600.00', 151),
(374, 397, '450.00', 151),
(375, 398, '200.00', 151),
(376, 399, '200.00', 151),
(377, 400, '3500.00', 151),
(378, 401, '50.00', 151),
(379, 402, '450.00', 151),
(380, 403, '330.00', 151),
(381, 404, '150.00', 151),
(382, 405, '350.00', 151),
(383, 406, '450.00', 151),
(384, 407, '3700.00', 151),
(385, 408, '1500.00', 151),
(386, 409, '5600.00', 151),
(387, 410, '300.00', 151),
(388, 411, '450.00', 151),
(389, 412, '90.00', 151),
(390, 413, '420.00', 151),
(391, 414, '150.00', 151),
(392, 416, '100.00', 151),
(393, 417, '800.00', 151),
(394, 418, '950.00', 151),
(395, 419, '3000.00', 151),
(396, 420, '250.00', 151),
(397, 421, '250.00', 151),
(398, 422, '130.00', 151),
(399, 423, '350.00', 151),
(400, 424, '550.00', 151),
(401, 425, '700.00', 151),
(402, 426, '250.00', 151),
(403, 427, '680.00', 151),
(404, 428, '1500.00', 151),
(405, 429, '2150.00', 151),
(406, 430, '750.00', 151),
(407, 431, '700.00', 151),
(408, 432, '700.00', 151),
(409, 433, '380.00', 151),
(410, 434, '450.00', 151),
(411, 435, '350.00', 151),
(412, 436, '5500.00', 151),
(413, 437, '250.00', 151),
(15415, 1, '135.00', 152),
(15417, 3, '150.00', 152);

-- --------------------------------------------------------

--
-- Table structure for table `price_version`
--

CREATE TABLE IF NOT EXISTS `price_version` (
  `PV_id` smallint(5) unsigned NOT NULL,
  `PV_user` int(10) unsigned NOT NULL,
  `PV_date` date NOT NULL,
  `PV_status` tinyint(1) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `price_version`
--

INSERT INTO `price_version` (`PV_id`, `PV_user`, `PV_date`, `PV_status`) VALUES
(151, 2, '2014-01-06', 2);

-- --------------------------------------------------------

--
-- Table structure for table `referred_tbl`
--

CREATE TABLE IF NOT EXISTS `referred_tbl` (
  `referred_id` smallint(5) unsigned NOT NULL,
  `referred_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `source_id` tinyint(3) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `relation_type`
--

CREATE TABLE IF NOT EXISTS `relation_type` (
  `RT_id` tinyint(1) unsigned NOT NULL,
  `RT_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `relation_type`
--

INSERT INTO `relation_type` (`RT_id`, `RT_name`) VALUES
(1, 'Father'),
(2, 'Mother'),
(3, 'Spouse'),
(4, 'Daughter'),
(5, 'Son');

-- --------------------------------------------------------

--
-- Table structure for table `sample_collection_tbl`
--

CREATE TABLE IF NOT EXISTS `sample_collection_tbl` (
  `SC_sl` int(10) NOT NULL,
  `SC_receipt_no` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `SC_collector_id` int(2) NOT NULL,
  `SC_status_id` int(2) NOT NULL,
  `SC_status_date1` datetime NOT NULL,
  `SC_status_date2` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(9) unsigned NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `setting_key` varchar(255) DEFAULT NULL,
  `setting` longtext,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `code`, `setting_key`, `setting`, `ts`) VALUES
(1, 'default', 'business_title', 'Skydyne', '2016-04-17 10:02:27'),
(2, 'default', 'business_contact', '8447024313', '2016-04-17 10:02:27'),
(3, 'default', 'email', 'skanta.it@gmail.com', '2016-04-17 10:02:27'),
(4, 'default', 'regd_no', '1234', '2016-04-17 10:02:27'),
(5, 'default', 'installed_on', '2016-04-17 03:32:27', '2016-04-17 10:02:27'),
(6, 'default', 'installation_type', 'trial', '2016-04-17 10:02:27'),
(7, 'default', 'trial_days', '15', '2016-04-17 10:02:27'),
(8, 'default', 'app_name', 'Automate - M', '2016-04-17 10:02:27'),
(9, 'default', 'address', 'asasa', '2016-04-17 10:02:27');

-- --------------------------------------------------------

--
-- Table structure for table `source_tbl`
--

CREATE TABLE IF NOT EXISTS `source_tbl` (
  `source_id` tinyint(3) unsigned NOT NULL,
  `source_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `source_tbl`
--

INSERT INTO `source_tbl` (`source_id`, `source_name`) VALUES
(7, 'ASHA'),
(14, 'C/O'),
(11, 'CHC'),
(9, 'Collection Centre'),
(4, 'Collector'),
(15, 'E-lab'),
(16, 'Fertility Centre'),
(17, 'Health Check Up Camp'),
(8, 'Hospital'),
(6, 'NGO'),
(13, 'Others'),
(12, 'Outsource'),
(10, 'PHC'),
(5, 'Runner'),
(3, 'Self / Walkin'),
(2, 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `state_tbl`
--

CREATE TABLE IF NOT EXISTS `state_tbl` (
  `state_id` tinyint(3) unsigned NOT NULL,
  `state_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `state_tbl`
--

INSERT INTO `state_tbl` (`state_id`, `state_name`) VALUES
(4, 'Assam'),
(7, 'Bihar'),
(3, 'Delhi'),
(1, 'Manipur'),
(2, 'Mizoram'),
(6, 'Myanmar'),
(5, 'Nagaland');

-- --------------------------------------------------------

--
-- Table structure for table `status_tbl`
--

CREATE TABLE IF NOT EXISTS `status_tbl` (
  `status_id` tinyint(3) unsigned NOT NULL,
  `status_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `status_dept_id` tinyint(2) unsigned NOT NULL,
  `status_table` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status_column` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `status_tbl`
--

INSERT INTO `status_tbl` (`status_id`, `status_name`, `status_dept_id`, `status_table`, `status_column`) VALUES
(1, 'Pending', 3, 'fd_report', ''),
(2, '', 0, '', ''),
(3, 'Cancelled Test', 0, 'fd_report', ''),
(4, 'Cancelled ED', 0, 'fd_report', ''),
(5, 'Delivered', 3, 'fd_report', ''),
(7, 'Not Applicable', 0, 'lab', ''),
(8, 'Collected', 4, 'lab', ''),
(9, 'Collected-FF', 4, 'lab', ''),
(10, 'Collected-PP', 4, 'lab', ''),
(11, 'Report Available', 3, 'fd_report', ''),
(12, 'Report Return', 3, 'fd_report', ''),
(13, 'Active', 2, 'discount_holder', 'DH_status'),
(14, 'Disabled', 2, 'discount_holder', 'DH_status'),
(15, '3 Months', 2, 'discount_holder', 'DH_validity'),
(16, '6 Months', 2, 'discount_holder', 'DH_validity'),
(17, '12 Months', 2, 'discount_holder', 'DH_validity'),
(18, '24 Months', 2, 'discount_holder', 'DH_validity'),
(19, '36 Months', 2, 'discount_holder', 'DH_validity'),
(20, '4 Years', 3, 'discount_holder', 'DH_validity'),
(21, 'Swap', 3, 'audit_tbl', 'A_action'),
(22, 'Add', 0, 'audit_tbl', 'A_action'),
(23, 'Edit', 0, 'audit_tbl', 'A_action'),
(24, 'Cancel', 0, 'audit_tbl', 'A_action'),
(25, 'Status', 0, 'audit_tbl', 'A_action'),
(26, 'Patient Registration', 0, 'audit_tbl', 'A_book'),
(27, 'Patient Investigation', 0, 'audit_tbl', 'A_book'),
(28, 'Patient Discount', 0, 'audit_tbl', 'A_book'),
(29, 'Customer Profile', 0, 'audit_tbl', 'A_book'),
(30, 'Not Applicable', 0, 'audit_tbl', 'A_remark'),
(31, 'Wrong entry by Front Staff', 0, 'audit_tbl', 'A_remark'),
(32, 'Customer Request', 0, 'audit_tbl', 'A_remark'),
(33, 'Added', 0, 'template_name', 'TPN_status'),
(34, 'Used', 0, 'template_name', 'TPN_status'),
(35, 'Disabled', 0, 'template_name', 'TPN_status'),
(36, '', 0, '', ''),
(37, '', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tax_tbl`
--

CREATE TABLE IF NOT EXISTS `tax_tbl` (
  `TX_id` int(10) unsigned NOT NULL,
  `TX_receipt_no` int(10) unsigned NOT NULL,
  `TX_value` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `template_body`
--

CREATE TABLE IF NOT EXISTS `template_body` (
  `TPB_id` int(10) unsigned NOT NULL,
  `TPB_tpn_id` int(10) unsigned NOT NULL,
  `TPB_name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `TPB_row` tinyint(3) unsigned NOT NULL,
  `TPB_column` tinyint(3) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `template_name`
--

CREATE TABLE IF NOT EXISTS `template_name` (
  `TPN_id` int(10) unsigned NOT NULL,
  `TPN_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `TPN_test_id` int(10) unsigned NOT NULL,
  `TPN_total_row` tinyint(3) unsigned NOT NULL,
  `TPN_total_column` tinyint(3) unsigned NOT NULL,
  `TPN_status` tinyint(3) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `template_value`
--

CREATE TABLE IF NOT EXISTS `template_value` (
  `TV_id` int(10) unsigned NOT NULL,
  `TV_template_body` int(10) unsigned NOT NULL,
  `TV_patient_test` int(10) unsigned NOT NULL,
  `TV_value` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `TV_row` tinyint(3) unsigned NOT NULL,
  `TV_column` tinyint(3) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `test_category`
--

CREATE TABLE IF NOT EXISTS `test_category` (
  `test_category_id` tinyint(3) unsigned NOT NULL,
  `test_category_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `TC_dept_id` tinyint(3) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `test_category`
--

INSERT INTO `test_category` (`test_category_id`, `test_category_name`, `TC_dept_id`) VALUES
(1, 'Histology', 5),
(2, 'Microbiology', 5),
(3, 'X-Ray', 8),
(4, 'Ultrasound', 6),
(5, 'Biochemistry', 5),
(6, 'Body Fluid', 5),
(7, 'ECG', 7),
(8, 'Haematology', 5),
(9, 'Serology', 5),
(10, 'Histopathology', 5),
(11, 'Clinical Pathology', 5),
(13, 'HORMONE', 5),
(14, 'CYTOLOGY', 5),
(15, 'CANCER MARKERS', 5);

-- --------------------------------------------------------

--
-- Table structure for table `test_old_price`
--

CREATE TABLE IF NOT EXISTS `test_old_price` (
  `OP_id` int(10) unsigned NOT NULL,
  `OP_test_id` int(10) unsigned NOT NULL,
  `OP_old_price` decimal(8,2) NOT NULL,
  `OP_user` int(10) unsigned NOT NULL,
  `OP_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `test_tbl`
--

CREATE TABLE IF NOT EXISTS `test_tbl` (
  `test_id` int(10) unsigned NOT NULL,
  `test_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `test_short_form` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `test_category_id` tinyint(3) unsigned NOT NULL,
  `test_price` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `test_tbl`
--

INSERT INTO `test_tbl` (`test_id`, `test_name`, `test_short_form`, `test_category_id`, `test_price`) VALUES
(1, 'Absolute Eosinophil Count', 'AEC', 8, '135.00'),
(2, 'Anti Cyclic Citrullinated Peptide', 'ANTI - CCP', 13, '1780.00'),
(3, 'Absolute Lymphocyte Count', 'ALC', 8, '150.00'),
(4, 'Absolute Neutrophil Count', 'ANC', 8, '130.00'),
(5, 'Adenosine Deaminase', 'ADA', 5, '550.00'),
(6, 'ALFA FETO PROTEIN', 'AFP', 15, '800.00'),
(7, 'Albumin', 'Albumin', 5, '100.00'),
(8, 'Albumin / Creatinine Ratio', 'ACR', 5, '350.00'),
(9, 'Albumin Globulin Ratio', 'AGR', 5, '150.00'),
(10, 'Alkaline Phosphatase', 'ALP', 5, '130.00'),
(12, 'Amylase', 'AMYLASE', 5, '350.00'),
(13, 'Anti Mullerian Hormone', 'AMH', 13, '1600.00'),
(14, 'Anti Nuclear Antibody', 'ANA', 13, '770.00'),
(16, 'ANTI THYROID PEROXIDASE ', 'ANTI TPO', 13, '1250.00'),
(17, 'Anti ds DNA', 'ANTI DS DNA', 13, '900.00'),
(18, 'Antenatal Profile', 'ANTENATAL PROFILE', 5, '1700.00'),
(20, 'Ascitic Fluid', 'ASCITIC FLUID', 6, '350.00'),
(22, 'ANTI STEPTOLYSIN O', 'ASO', 9, '480.00'),
(23, 'BETA - HCG', 'BETA - HCG', 5, '600.00'),
(24, 'Bile Pigment', '', 11, '90.00'),
(25, 'Bile Salt', '', 11, '90.00'),
(26, 'Bilirubin ( Total & Conjugate)', 'Tsb', 5, '200.00'),
(27, 'Blast Cells', '', 8, '50.00'),
(28, 'Blood Grouping', 'ABO', 8, '90.00'),
(29, 'Blood RE', 'BLOOD RE', 8, '300.00'),
(30, 'BLEEDING TIME', 'BT', 8, '60.00'),
(31, 'BLOOD UREA NITROGEN', 'BUN', 5, '100.00'),
(32, 'CA 125', 'CA 125', 15, '990.00'),
(33, 'Calcium', 'CALCIUM', 5, '160.00'),
(34, 'Calcium Profile', 'CALCIUM PROFILE', 5, '430.00'),
(35, 'CARCINOEMBRYONIC ANTIGEN', 'CEA', 15, '650.00'),
(36, 'CHLORIDE', 'CL', 5, '130.00'),
(37, 'Cholesterol', 'CHOLESTEROL', 5, '200.00'),
(38, 'CREATININE KINASE - NAC', 'CK - NAC', 5, '250.00'),
(39, 'CKMB', 'CKMB', 5, '350.00'),
(40, 'Clot Retraction Time', 'CLOT RETRACTION TIME', 8, '80.00'),
(41, 'CMV IgG & IgM', 'CMV IgG &IgM', 13, '750.00'),
(42, 'CMV IgG', 'CMV IgG', 13, '400.00'),
(43, 'CMV IgM', 'CMV IgM', 13, '400.00'),
(44, 'Coagulation Profile', '', 8, '500.00'),
(45, 'Cold Agglutination', '', 8, '110.00'),
(46, 'Complete Haemogram', 'CBC', 8, '400.00'),
(47, 'COOMB''S Test - Direct', 'COOMBS TEST DIRECT', 8, '200.00'),
(48, 'COOMB''S Test - Indirect', 'COOMBS TEST INDIRECT', 8, '250.00'),
(49, 'Creatine Clearance', '', 5, '330.00'),
(50, 'C REACTIVE PROTEIN', 'CRP', 9, '350.00'),
(51, 'CEREBO SPINAL FLUID  ROUTINE EXAMINATION', 'CSF RE', 6, '350.00'),
(52, 'CLOTTING TIME', 'CT', 8, '60.00'),
(53, 'Creatinine', 'CREATININE', 5, '120.00'),
(54, 'Culture & Sensitivity', '', 2, '430.00'),
(55, 'Differential Leucocyte Count', 'DLC', 8, '90.00'),
(56, 'Duplicate Report', '', 0, '50.00'),
(57, 'Duplicate Report ', '', 0, '100.00'),
(58, 'ECG Auto', 'ECG - Auto', 7, '200.00'),
(60, 'Electrolyte', 'ELECTROLYTE', 5, '330.00'),
(61, 'ESR', 'ESR', 8, '90.00'),
(62, 'Estradiol-Oestradiol (E2)', 'Estradiol', 13, '480.00'),
(63, 'FIBRINOGEN DEGRADATION PRODUCTS', 'FDP', 5, '690.00'),
(64, 'FERRITIN', 'FERRITIN', 5, '550.00'),
(65, 'FINE NEEDLE ASPIRATION CYTOLOGY (One Site)', 'FNAC (ONE SITE)', 14, '350.00'),
(66, 'FINE NEEDLE ASPIRATION CYTOLOGY (Two Site)', 'FNAC (TWO SITE)', 14, '350.00'),
(67, 'FINE NEEDLE ASPIRATION CYTOLOGY  (Ultrasound Guide)', 'USG (FNAC)', 14, '770.00'),
(68, 'Free - T3', 'FREE - T3', 5, '350.00'),
(69, 'Free - T4', 'FREE - T4', 5, '350.00'),
(70, 'Free - T3 + T4', 'FREE - T3/T4', 5, '630.00'),
(71, 'FOLLICLE STIMULATING HORMONE', 'FSH', 13, '480.00'),
(72, 'Fungal Study', 'FUNGAL STUDY', 2, '150.00'),
(73, 'GCP -Dehydrogenation', 'GCP - DEHYDROGENATIO', 13, '350.00'),
(74, 'Gamma GT', 'GGT', 5, '150.00'),
(75, 'Geimsa Stain', 'GIMSA', 2, '430.00'),
(76, 'General Blood Pictures', 'GBP', 8, '100.00'),
(77, 'Glycosylated (HBA 1C)', 'HBa1C', 5, '490.00'),
(78, 'Globulin', 'GLOBULIN', 5, '70.00'),
(79, 'Gram Stain', 'GRAM STAIN', 2, '150.00'),
(80, 'Glucose Tolerance Test', 'GTT', 5, '370.00'),
(81, 'Glucose Tolerance Test 100 gms', 'GTT - 100gms', 5, '300.00'),
(82, 'Glucose Tolerance Test 3 Hrs', 'GTT - 3hrs', 5, '300.00'),
(83, 'H. Pylori', 'H. PYLORI', 2, '570.00'),
(84, 'Haemoglobin', 'Hb', 8, '80.00'),
(85, 'HBsAg', 'HBsAg', 9, '280.00'),
(86, 'Hepatitis A (HAV), IgG / IgM', '', 9, '1350.00'),
(87, 'Hepatitis A (HAV), IgG', '', 9, '800.00'),
(88, 'Hepatitis A (HAV), IgM', '', 9, '800.00'),
(89, 'Hepatitis C ', 'HCV', 9, '450.00'),
(90, 'HDL - Cholesterol', 'HDL', 5, '240.00'),
(91, 'HEV - IgG', 'HEV - IgG', 9, '550.00'),
(92, 'HIV / R - Antibody', 'RETRO', 9, '450.00'),
(93, 'BIOPSY (Big/Large)', 'BIOPSY (BIG/LARGE)', 10, '1100.00'),
(94, 'BIOPSY (Medium)', 'BIOPSY (MEDIUM)', 10, '650.00'),
(95, 'Homocystine', '', 5, '950.00'),
(96, 'HSV, IgG Antibody', '', 2, '480.00'),
(97, 'HSV, IgM Antibody', '', 2, '480.00'),
(98, 'HSV, IgG + IgM Antibody', '', 2, '950.00'),
(99, 'IGE Total', 'IGE TOTAL', 5, '600.00'),
(100, 'Inorganic Phosphorous', '', 5, '150.00'),
(101, 'IRON / TIBC / UIBC', '', 5, '400.00'),
(102, 'KIDNEY FUNCTION TEST/RENAL FUNCTION TEST', 'KFT/RFT', 5, '580.00'),
(103, 'L.E. Cell Test', '', 8, '180.00'),
(104, 'Lactate Dehydrogenase (LDH Serum)', 'LDH Serum', 5, '250.00'),
(105, 'LDL - Cholesterol', '', 13, '300.00'),
(107, 'LIVER FUNCTION TEST', 'LFT', 5, '650.00'),
(108, 'Luteinizing Hormone', 'LH', 13, '480.00'),
(109, 'Lipase', 'LIPASE', 5, '350.00'),
(110, 'Lipid Profile', 'LIPID PROFILE', 5, '700.00'),
(111, 'Magnesium', 'MG', 5, '300.00'),
(112, 'Malarial Parasite (OMT)', 'MP - OMT', 8, '350.00'),
(113, 'Malarial Parasite (SMEAR)', 'MP - SMEAR', 8, '100.00'),
(114, 'Malarial Parasite (QBC)', 'MP - QBC', 8, '350.00'),
(115, 'Mantoux Test', 'MX', 2, '100.00'),
(116, 'Malignant Cell (Body Fluid)', '', 14, '180.00'),
(117, 'Malignant Cell (Sputum)', '', 14, '180.00'),
(118, 'Malignant Cell ', '', 14, '180.00'),
(119, 'MEAN CELL VOLUME', 'MCV', 8, '50.00'),
(120, 'MEAN CELL HEMOGLOBIN', 'MCH', 8, '50.00'),
(121, 'MEAN CELL HEMOGLOBIN CORPUSCULAR', 'MCHC', 8, '50.00'),
(122, 'MYCODOT TB (IgG, IgM, ELISA)', 'MYCODOT IgG/IgM', 2, '1100.00'),
(123, 'MYCODOT Test', 'MYCODOT', 2, '500.00'),
(124, 'Nail Clipping For Fungus', '', 2, '150.00'),
(125, 'Nasal Discharge Eosinophil', '', 2, '120.00'),
(126, 'Occult Blood', '', 11, '130.00'),
(127, 'Osmotic Fragility', '', 8, '330.00'),
(128, 'OVA And CYST (Stool)', '', 11, '80.00'),
(129, 'PAP SMEAR', 'PAP SMEAR', 14, '250.00'),
(130, 'PAP STAIN', 'PAP STAIN', 14, '430.00'),
(131, 'Partial Thromboplastin Timekinase ', 'PTTK / APTT', 8, '330.00'),
(132, 'Haematocrit', 'PCV / HCT', 8, '90.00'),
(133, 'Platelet Count', 'PLATELET COUNT', 8, '90.00'),
(134, 'Pleural Fluid', '', 6, '350.00'),
(135, 'Lactate Dehydrogenase (LDH Fluid)', 'LDH Fluid', 6, '220.00'),
(136, 'Pericardial Fluid', '', 6, '350.00'),
(137, 'Peritoneal Fluid', '', 6, '350.00'),
(138, 'Potassium', '', 5, '130.00'),
(139, 'Pregnancy Test', '', 5, '110.00'),
(140, 'Prolactin', '', 5, '480.00'),
(141, 'Protein (Total, Albumin, Globulin)', '', 5, '120.00'),
(142, 'Prothrombin Time', 'PT', 5, '280.00'),
(143, 'PROSTATE SPECIFIC ANTIGEN (Free)', 'PSA (Free)', 15, '700.00'),
(144, 'PROSTATE SPECIFIC ANTIGEN (Total)', 'PSA (Total)', 15, '700.00'),
(146, 'PUS Culture', '', 2, '430.00'),
(148, 'RBC Count', 'RBC COUNT', 8, '90.00'),
(149, 'RWD', '', 8, '20.00'),
(150, 'Reticulocyte Count', '', 8, '150.00'),
(151, 'Rubella Antibodies IgG', '', 2, '400.00'),
(152, 'Rubella Antibodies IgM', '', 2, '400.00'),
(153, 'Rubella Antibodies IgG & IgM', '', 2, '750.00'),
(154, 'Rheumatoid Factor', 'RF', 2, '380.00'),
(155, 'Semen Analysis', 'SEMEN', 2, '350.00'),
(156, 'Seminal Culture', 'SEMEN C/S', 2, '430.00'),
(157, 'Serum Iron Profile', 'SIP', 5, '700.00'),
(158, 'Serum Iron', 'IRON', 5, '330.00'),
(159, 'SGOT / AST', 'SGOT / AST', 5, '130.00'),
(160, 'SGPT / ALT', 'SGPT / ALT', 5, '130.00'),
(161, 'Sickling Test', '', 8, '300.00'),
(162, 'Sodium', '', 5, '130.00'),
(163, 'Sputum AFB', 'SPUTUM AFB', 2, '150.00'),
(164, 'Sputum Culture & Sensitivity', 'SPUTUM C/S', 2, '430.00'),
(165, 'Stool RE', 'STOOL RE', 2, '150.00'),
(166, 'Stool Culture & Sensitivity', 'STOOL C/S', 2, '430.00'),
(167, 'Sugar (Fasting)', 'BSF', 5, '100.00'),
(168, 'Sugar (PP)', 'BSPP', 5, '100.00'),
(169, 'Sugar (Random)', 'RBS', 5, '100.00'),
(170, 'Synovial Fluid', '', 6, '350.00'),
(171, 'T3', 'T3', 5, '260.00'),
(172, 'T4', 'T4', 5, '260.00'),
(173, 'THYROID FUNCTION TEST', 'TFT', 5, '650.00'),
(174, 'Thyroid Stimulating Hormone', 'TSH', 13, '260.00'),
(175, 'Throat Culture (Swab)', 'THROAT C/S', 2, '430.00'),
(176, 'Torch (IgG / IgM)', 'TORCH', 5, '2500.00'),
(177, 'Total Leucocyte Count', 'TLC', 8, '90.00'),
(178, 'Toal Iron Binding Capacity', 'TIBC', 5, '110.00'),
(179, 'Total Granulocyte Count', 'TGC', 8, '80.00'),
(180, 'Toxoplasma Antibody (IgG)', '', 2, '400.00'),
(181, 'Toxoplasma Antibody (IgM)', '', 2, '400.00'),
(182, 'Triglyceride', '', 5, '200.00'),
(183, 'Troponin I', '', 5, '780.00'),
(184, 'Tiphidot Test', '', 9, '350.00'),
(186, 'Urea', 'UREA', 5, '120.00'),
(187, 'Uric Acid', 'Uric Acid', 5, '150.00'),
(188, 'Urinary Albumin 24hr / Random', '', 11, '350.00'),
(189, 'Urinary Amylase', '', 11, '350.00'),
(190, 'Urinary Calcium 24hrs Random', '', 11, '160.00'),
(191, 'Urinary Chloride 24hrs (RBS)', '', 11, '200.00'),
(192, 'Urinary Haemoglobin', '', 11, '100.00'),
(193, 'Urinary Malignant Cell', '', 11, '180.00'),
(194, 'Urinary Phosphorous 24hrs / Random', '', 11, '150.00'),
(195, 'Urinary Potassium 24hrs / Random', '', 11, '130.00'),
(196, 'Urinary Sodium 24hrs / Random', '', 11, '150.00'),
(197, 'Urinary Uric Acid 24hrs / Random', '', 11, '150.00'),
(198, 'Urinary Urea 24hrs / Random', '', 11, '120.00'),
(199, 'Urine SP-Gravity', '', 11, '40.00'),
(200, 'Urine (Bence John Protein)', '', 11, '100.00'),
(201, 'Urine AFB', 'Urine AFB', 11, '150.00'),
(202, 'Urine Creatinine 24hrs', '', 11, '120.00'),
(203, 'Urine Culture And Sensitivity', 'URINE C/S', 11, '430.00'),
(204, 'Urine Microalbumine', '', 11, '350.00'),
(205, 'Urine Protein 24hrs', '', 11, '220.00'),
(206, 'Urine Protein', '', 11, '50.00'),
(207, 'Urine Protein Creatinine Ratio', '', 11, '370.00'),
(208, 'Urine Ketone Bodies', '', 11, '90.00'),
(209, 'Urine RE', 'URINE R/E', 11, '130.00'),
(210, 'Urine Sugar', '', 11, '90.00'),
(211, 'Urobilinogen', '', 11, '60.00'),
(212, 'VDRL / RPR', 'VDRL / RPR', 9, '150.00'),
(213, 'Vaginal Swab', '', 2, '180.00'),
(214, 'Vaginal Swab Culture', '', 2, '430.00'),
(215, 'Vitamin D3', '', 5, '1700.00'),
(216, 'Widal', 'WIDAL', 9, '180.00'),
(217, 'USG (WHOLE ABDOMEN)', 'USG (W/A)', 4, '750.00'),
(218, 'USG W/A (Screening)', 'USG (W/A - SCREENING', 4, '500.00'),
(219, 'USG (Lower Abdomen)', 'USG (L/A)', 4, '450.00'),
(220, 'USG Lower Abdomen (Screening)', 'USG (L/A - SCREENING', 4, '350.00'),
(221, 'USG (Upper Abdomen)', 'USG (U/A)', 4, '450.00'),
(222, 'USG Upper Abdomen (Screening)', 'USG (U/A - SCREENING', 4, '350.00'),
(223, 'USG (KUB)', 'USG (KUB)', 4, '450.00'),
(224, 'USG KUB (Screening)', 'USG (KUB SCREENING)', 4, '350.00'),
(225, 'USG - Foetal Well Being ( FWB )', 'USG (FWB)', 4, '550.00'),
(226, 'USG - Foetal Well Being ( Screening)', 'USG (FWB (SCREENING)', 4, '350.00'),
(227, 'USG Trans Vaginal Sonography', 'USG (TVS)', 4, '480.00'),
(228, 'USG TVS With FCS', 'USG (TVS / FCS)', 4, '480.00'),
(229, 'USG Trans Vaginal Sonography (screening)', 'USG (TVS Screening)', 4, '350.00'),
(230, 'USG ( FCS )', 'USG (FCS)', 4, '350.00'),
(232, 'USG (Scrotum)', 'USG (SCROTUM)', 4, '750.00'),
(233, 'USG (Breast)', 'USG (BREAST)', 4, '750.00'),
(234, 'USG (Prostate)', 'USG (PROSTATE)', 4, '450.00'),
(235, 'USG (G.B. Area)', 'USG GB AREA', 4, '450.00'),
(236, 'USG (Pelvis)', 'USG (PELVIS)', 4, '450.00'),
(237, 'Whole Abdomen & T.V.S', 'WA/TVS', 4, '1150.00'),
(238, 'Whole Abdomen & F.W.B', 'WA / FWB', 4, '1250.00'),
(239, 'Blood Culture', 'BLOOD C / S', 2, '800.00'),
(240, 'Dorsal Spine AP / Lat', 'DS', 3, '380.00'),
(242, 'X - Ray Angiogram', 'Angiogram', 3, '370.00'),
(243, 'X - Ray Ankle Joint AP / LAT', 'Ankle Joint AP/LAT', 3, '350.00'),
(244, 'X - Ray Ankles AP / LAT(Both)', 'Ankle AP/LAT (BOTH)', 3, '480.00'),
(245, 'X - Ray Arm AP / LAT', 'Arm AP/LAT', 3, '350.00'),
(246, 'X - Ray Barium Enema - Fasting', 'Barium Enema Fasting', 3, '1200.00'),
(247, 'X - Ray Bariun Follow Through - Fasting', 'Barium Follow Throug', 3, '1200.00'),
(248, 'X - Ray Meal Stomach / Duodenum - Fasting', 'Meal Duodenem Fastin', 3, '1200.00'),
(249, 'X - Ray Barium Swallow Oesophagus', 'Barium Swallow Oesop', 3, '600.00'),
(250, 'X - Ray Base Of Skull ', 'Base Of Skull ', 3, '270.00'),
(251, 'X - Ray Calcaneum Axial View', 'Calcaneum Axil View', 3, '270.00'),
(252, 'X - Ray Cervical Flexion & Extension', 'Cervical Flexion & E', 3, '380.00'),
(253, 'X - Ray Cervical Spine Both Oblique', 'Cervical Spine Obliq', 3, '380.00'),
(254, 'X - Ray Cervical Spine AP/LAT', 'Cervical Spine AP/LA', 3, '400.00'),
(256, 'X - Ray Chest AP', 'Chest AP', 3, '270.00'),
(257, 'X - Ray Chest AP & LAT', 'Chest AP / LAT', 3, '490.00'),
(258, 'X - Ray Chest LAT View', 'Chest LAT VIEW', 3, '270.00'),
(259, 'X - Ray Chest PA View', 'CXR - PAV', 3, '270.00'),
(260, 'X - Ray Chest PA & LAT. View', 'Chest PA/LAT View', 3, '450.00'),
(261, 'X - Ray Chest Small', 'Chest Small', 3, '250.00'),
(262, 'X - Ray Clavicle', 'Clavicle', 3, '270.00'),
(263, 'X - Ray Dorso Lumbar Spine AP/LAT', 'DL SPINE AP/LAT', 3, '440.00'),
(264, 'X - Ray Elbow AP/LAT', 'Elbow AP/LAT', 3, '350.00'),
(265, 'X - Ray Elbows (Both)', 'Elbow (BOTH)', 3, '400.00'),
(266, 'X - Ray Feet AP/LAT', 'Feet AP/LAT', 3, '350.00'),
(267, 'X - Ray Feet (Both)', 'Feet (BOTH)', 3, '400.00'),
(268, 'X - Ray Femur AP', 'Femur AP', 3, '250.00'),
(269, 'X - Ray Femur AP/LAT', 'Femur AP/LAT', 3, '400.00'),
(270, 'X - Ray Forearm AP/LAT', 'Forearm AP/LAT', 3, '350.00'),
(271, 'X - Ray Forearms (Both)', 'Forearm (BOTH)', 3, '480.00'),
(272, 'X - Ray Hand AP/LAT', 'Hand AP/LAT', 3, '350.00'),
(273, 'X - Ray Hands (Both)', 'Hands (BOTH)', 3, '480.00'),
(274, 'X - Ray Heel', 'Heel', 3, '270.00'),
(275, 'X - Ray Heels (Both)', 'Heels (BOTH)', 3, '400.00'),
(276, 'X - Ray Hip  AP/LAT', 'Hip Join AP/LAT', 3, '380.00'),
(277, 'X - Ray Hip Join AP', 'Hip Join AP', 3, '270.00'),
(278, 'X - Ray Hip LAT', 'Hip LAT', 3, '270.00'),
(279, 'X - Ray Humerus AP/LAT', 'Humers AP/LAT', 3, '350.00'),
(280, 'X - Ray Hystero - S - Gram', 'HSG', 3, '1200.00'),
(281, 'X - Ray I.V.P Series', 'IVP', 3, '1200.00'),
(282, 'X - Ray K.U.B. ', 'KUB', 3, '270.00'),
(283, 'X - Ray Knee Joint AP/LAT', 'Knee Joint AP/LAT', 3, '400.00'),
(284, 'X - Ray Knee (Both) AP', 'Knee AP (BOTH)', 3, '250.00'),
(285, 'X - Ray L.S. Spine AP/LAT', 'LS SPINE AP/LAT', 3, '380.00'),
(286, 'X - Ray L.S. Spine Both Oblique View', 'LS Spine Both Obliqu', 3, '380.00'),
(287, 'X - Ray L.S. Spine Flexion & Extension', 'LS Spine Flexion & E', 3, '380.00'),
(288, 'X - Ray Leg AP/LAT', 'Leg AP/LAT', 3, '400.00'),
(289, 'X - Ray L.S. Spine Lateral View', 'LS Spine LAT View', 3, '270.00'),
(290, 'X - Ray Mandible AP/LAT', 'Mandible AP/LAT', 3, '250.00'),
(291, 'X - Ray Mandible Both LAT/Oblique', 'Mandible Both LAT/Ob', 3, '350.00'),
(292, 'X - Ray Mandible LAT Oblique', 'Mandible LAT Oblique', 3, '350.00'),
(293, 'X - Ray Mastoid (Law''s View)', 'Mastoid Law View', 3, '270.00'),
(294, 'X - Ray Mastoid (Town''s View/LAT)', 'Mastoid Town View/LA', 3, '380.00'),
(295, 'X - Ray Mastoid (Town''s  And Law''s View)', 'Mastoid (Town / Law ', 3, '380.00'),
(296, 'X - Ray Mastoid Town''s View', 'Mastoid Town View', 3, '270.00'),
(297, 'X - Ray Micturiting Cystourethrogram', 'Micturiting Cystoure', 3, '1200.00'),
(298, 'X - Ray Myelogram', 'Myelogram', 3, '750.00'),
(299, 'X - Ray Nasal Bone', 'Nasal Bone', 3, '270.00'),
(300, 'X - Ray Nasophyarynx LAT', 'Nasophyarynx LAT', 3, '270.00'),
(301, 'X - Ray  Foot AP/LAT', 'Foot AP/LAT', 3, '350.00'),
(302, 'X - Ray  Spine AP/LAT', 'Spine AP/LAT', 3, '400.00'),
(303, 'X - Ray Orbits AP / LAT View', 'Orbits AP/LAT', 3, '350.00'),
(304, 'X - Ray P.N.S', 'PNS', 3, '270.00'),
(305, 'X - Ray Patella', 'Patella', 3, '270.00'),
(306, 'X - Ray Pelvis AP / LAT', 'Pelvis AP/LAT', 3, '400.00'),
(307, 'X - Ray Pelvis Both S.I. Joint', 'Pelvis Both SI Joint', 3, '380.00'),
(308, 'X - Ray S.I. Joint', 'SI Joint', 3, '270.00'),
(309, 'X - Ray S.I. Joint Both Oblique', 'SI Joint Oblique', 3, '380.00'),
(310, 'X - Ray Scapula', 'Scapula', 3, '270.00'),
(311, 'X - Ray Shoulder', 'Shoulder', 3, '270.00'),
(312, 'X - Ray Shoulder AP / LAT', 'Shoulder AP/LAT', 3, '380.00'),
(315, 'X - Ray Skull (LAT)', 'Skull LAT', 3, '270.00'),
(316, 'X - Ray Skull AP / LAT', 'Skull AP/LAT', 3, '380.00'),
(317, 'X - Ray Soft Tissue Neck AP', 'Soft Tissue Neck AP', 3, '270.00'),
(318, 'X - Ray Soft Tissue Neck AP / Lateral', 'Soft Tissue Neck AP/', 3, '380.00'),
(319, 'X - Ray Sternum AP / Lat', 'Sternum AP/LAT', 3, '370.00'),
(320, 'X - Ray Sternum Lat', 'Sternum LAT', 3, '270.00'),
(321, 'X - Ray Thigh AP/LAT', 'Thigh AP/LAT', 3, '350.00'),
(322, 'X - Ray Thigh (Both)', 'Thinh (BOTH)', 3, '400.00'),
(323, 'X - Ray Thoraco Lumbar Spine', 'Thoraco Lumbar Spine', 3, '400.00'),
(325, 'X - Ray Wrist Joints AP / LAT', 'Wrist Joint AP/LAT', 3, '350.00'),
(326, 'X - Ray Wrists (BOTH)', 'Wrists (BOTH) ', 3, '400.00'),
(327, 'X - Ray Apicogram', 'Apicogram', 3, '270.00'),
(328, 'X - Ray Both T.M. Joint', 'Both TM Joint', 3, '450.00'),
(329, 'X - Ray Calcaneum', 'Calcaneum', 3, '270.00'),
(330, 'X - Ray Cocyx -AP / LAT', 'Cocyx AP/LAT', 3, '380.00'),
(331, 'X - Ray Dorso - Lumbar Spine - Lat View', 'DL Spine LAT', 3, '270.00'),
(333, 'X - Ray Retrograde Urethrogram', 'RGU', 3, '1200.00'),
(334, 'X - Ray S.I. Joint AP / Oblique', 'SI Joint AP/Oblique', 3, '400.00'),
(336, 'X - Ray Styloid Process', 'Styloid Process', 3, '270.00'),
(337, 'X - Ray T.M. Joint Open Mouth & Closed', 'TM Joint Open Mouth ', 3, '380.00'),
(338, 'X - Ray T - Tube Cholangiogram', 'T-Tube Cholangiogram', 3, '1200.00'),
(339, 'X - Ray Legs (Both)', 'Legs (BOTH)', 3, '370.00'),
(340, 'X - Ray  Abdomen ERECT AP', 'Abdomenn Erect AP', 3, '270.00'),
(341, 'Toxoplasma Antibody IgG, IgM', 'TOXO', 5, '750.00'),
(342, 'VLDL - Cholesterol', 'VLDL', 5, '280.00'),
(343, 'USG (APPENDIX AREA)', 'USG (APPENDIX AREA)', 4, '250.00'),
(344, 'USG (PERIUMBILICAL AREA)', 'USG', 4, '250.00'),
(345, 'USG (PELVIS + SCREENING)', 'USG', 4, '350.00'),
(346, 'USG (AXILLA)', 'USG', 4, '450.00'),
(348, 'X - RAY Thumb AP/LAT', 'THUMB AP/LAT', 3, '320.00'),
(349, 'X - Ray BIG TOE', 'BIG TOE', 3, '250.00'),
(350, 'X - RAY Finger AP/LAT', 'Finger AP/LAT', 3, '320.00'),
(351, 'X - RAY Dorsal Spine AP/LAT', 'Dorsal Spine AP/LAT', 3, '400.00'),
(355, 'LllYoyo', 'DfsY', 15, '100.00'),
(356, 'Courier Charge (Rs. 250)', 'CC250', 0, '250.00'),
(357, 'TB - Quantiferon', 'TBQ', 2, '2350.00'),
(358, 'HCV-RNA-Qualitative', 'HCV-RNA-QL', 2, '0.00'),
(359, 'HCV-RNA-Quantitative/Viral Load ', 'HCV-RNA-QT', 2, '0.00'),
(360, 'HCV-RNA-Genotype', 'HCV-RNA-G', 2, '0.00'),
(361, 'Urine Spot Protein', 'Urine Spot P', 0, '220.00'),
(362, 'Urine Spot Creatinine', 'Urine Spot Crea', 0, '120.00'),
(363, 'BIOPSY (SMALL)', 'BIOPSY SMALL)', 10, '500.00'),
(364, 'X - Ray L.S. Spine AP', 'LS SPINE AP', 3, '270.00'),
(365, 'Tacrolimus', 'TACROLIMUS', 0, '2500.00'),
(366, 'ANA By IF Pattern', 'IF PATTERN ANA', 0, '825.00'),
(367, 'ANCA', 'ANCA', 0, '1600.00'),
(368, 'ANTI TG', 'TG ANTI', 0, '950.00'),
(370, 'CA 19.9', '19.9 CA', 0, '1050.00'),
(371, 'Testesterone', 'TESTESTERONE', 0, '660.00'),
(372, 'PTH (IPTH)', '(IPTH) PTH', 0, '1450.00'),
(374, 'CD4 Count', 'CD4 COUNT', 0, '900.00'),
(376, 'CD8 Count', 'CD8 COUNT', 0, '1250.00'),
(377, 'Progesterone', 'PROGESTERONE', 0, '600.00'),
(378, 'Hb Electrophoresis', 'Hb - ELECTROPHORESIS', 0, '800.00'),
(379, 'Urine For VMA', 'VMA - URINE', 0, '2800.00'),
(380, 'Urine For VMA', 'VMA - URINE', 0, '2800.00'),
(382, 'Medicine Charge', 'MEDICINE CHARGE', 3, '220.00'),
(383, 'Fungal Culture', 'FUNGAL C/S', 2, '430.00'),
(384, 'X - Ray Wrists Joint', 'Wrists Joint', 3, '270.00'),
(385, 'USG Whole Of The Guteal Mass', 'USG Guteal Mass', 4, '450.00'),
(386, 'Typhidot / Enteriocheck', 'TYPHIDOT', 9, '350.00'),
(387, 'Bleeding Time, Clotting Time', 'BT, CT', 8, '120.00'),
(388, 'X - Ray Lumbar Spine Ap/lateral', 'X-ray Lumbar Spine A', 3, '380.00'),
(389, 'Bicarbonate (HCO 3)', 'Bica', 5, '800.00'),
(390, 'Night Charge', 'NC', 4, '50.00'),
(391, 'Hepatitis B (revac - B) Vaccination', 'Revac - B', 0, '100.00'),
(392, 'USG (THYROID)', 'THYROID (USG)', 4, '750.00'),
(393, 'USG (INGURAL REGION)', '(USG)INGURAL REGION', 4, '450.00'),
(394, 'Antinatal Profile', 'ANTI PROFILE', 0, '1800.00'),
(395, 'USG Bilateral Breast', 'USG (BILATERAL BREAS', 4, '700.00'),
(396, 'APLA', 'Apla', 2, '1450.00'),
(397, 'USG ( NECK )', 'Usg Neck', 4, '700.00'),
(398, 'Issue Of Block And Slide', 'Block And Slide', 11, '200.00'),
(399, 'MER', 'MER', 0, '200.00'),
(400, 'Renal Biopsy For Light Microscopy And IF', 'RENAL BIOPSY', 0, '3500.00'),
(401, 'UPT Kit', 'UPT KIT', 4, '50.00'),
(402, 'USG Of The Abscess Gluteal Region', 'GLUTEAL REGION', 4, '450.00'),
(403, 'Fluid Analysis R/E', 'Fluid R/E', 10, '330.00'),
(404, 'Fluid Analysis AFB', 'FLUID AFB', 10, '150.00'),
(405, 'FNAC Of The Thyroid Nodule', 'FNAC THYROID NODULE', 11, '350.00'),
(406, 'USG (Breast One Site)', 'USG (BREAST) ', 4, '450.00'),
(407, 'HCV - Qualitative', 'HCV - (QUALITATIVE)', 0, '3700.00'),
(408, 'HCV Qualitative', 'Hcv', 2, '1500.00'),
(409, 'HBV - Quantitative ', 'HBV - QT', 0, '5600.00'),
(410, 'HbeAg', 'HbeAg', 2, '300.00'),
(411, 'USG (Scrotum)', 'USG - SCROTUM', 4, '450.00'),
(412, 'Stool For Hanging', 'Stool', 2, '90.00'),
(413, 'Scrub Typhus Antibody', 'SCRUB TYPHUS - Ab', 2, '420.00'),
(414, 'Pus For AFB Stain', 'Pus AFB', 2, '150.00'),
(416, 'OPD (Out Patient Department)', 'OPD', 0, '100.00'),
(417, 'HIV P-24', 'HIV P-24', 9, '800.00'),
(418, 'Pus AFB Culture', 'PUS (AFB) CULTURE ', 2, '950.00'),
(420, 'X - Ray Abdomen Erect PA', 'Abdomen Erect PA', 3, '250.00'),
(421, 'X - Ray Abdomen Supine AP', 'Abdomen Supine AP', 3, '250.00'),
(422, 'Scrapping (Leg Skin Lesion)', 'Scrapping Leg Skin L', 2, '130.00'),
(423, 'Nasal Bone AP/LAT', 'Nasal', 3, '350.00'),
(424, 'C3 Compliment', 'C3', 9, '550.00'),
(425, 'Cryoglobulins', 'Cryoglobulins', 9, '700.00'),
(426, 'X - Ray Pelvis ', 'X - RAY PELVIS ', 3, '290.00'),
(427, 'Serum Insulin (fasting)', 'SER. INSULIN (fASTIN', 0, '680.00'),
(428, 'Lupus Anticoagulants (LAC)', 'LUPUS (LAC)', 0, '1500.00'),
(429, 'Anti - Cardiolipin / Cardiolipin Antibody ( IgA, IgG, IgM )', 'ACL', 0, '2150.00'),
(430, 'Anti - Cardiolipin / Cardiolipin Antibody - ( IgA )', 'ACL - IgA', 0, '750.00'),
(431, 'Anti - Cardiolipin / Cardiolipin Antibody - (igG)', 'ACL - (IgG)', 0, '700.00'),
(432, 'Anti - Cardiolipin / Cardiolipin Antibody - (igM)', 'ACL - (IgM)', 0, '700.00'),
(433, 'C/s  Of Skin', 'C/s Of Skin Swap', 10, '380.00'),
(434, 'USG Calf', 'Calf', 4, '450.00'),
(435, 'Minor OT Charge', 'OT', 10, '350.00'),
(436, 'ALPA Panel', 'ALPA ', 13, '5500.00'),
(437, 'X- Ray Forearm AP', 'Forearm', 3, '250.00'),
(438, 'Pleural Fluid Culture And Sensitivity', 'Plueral Fluid C/s', 10, '430.00'),
(439, 'USG (Thigh)', 'USG (thigh)', 4, '450.00'),
(440, 'PTH (iPTH)', 'PTH (IPTH)', 0, '1290.00'),
(441, 'Free Testesterone', 'Free Testesterone', 0, '1200.00'),
(442, 'Serum Or Protein Electrophoresis', 'Serum Or Protein Ele', 0, '800.00'),
(443, 'Serum Insulin', 'S. Insulin', 0, '680.00'),
(444, 'Peritonal Fluid For Culture And Sensitivity', 'Body Fluid C/S', 2, '430.00'),
(445, 'Sterile Culture', 'Culture', 2, '380.00'),
(446, 'Swab Culture', 'Swab', 2, '430.00'),
(447, 'Biopsy Large ', 'BL(extra 20%)', 1, '1320.00'),
(448, 'Triple Marker Test', 'TMT', 0, '2400.00'),
(449, 'X-Ray Both Knee AP/LAT', 'Knee', 3, '700.00'),
(450, 'Quadruple Marker Test', 'Marker', 0, '2500.00'),
(451, 'UGI Endoscopy', 'Endoscopy', 4, '1000.00'),
(452, 'Creatinine Phosphokinase [CPK]', 'CPK', 5, '240.00'),
(453, 'Vitamin B12', 'Vit B', 5, '880.00'),
(454, 'HBV-DNA_QT', 'Hbv', 9, '2500.00'),
(455, 'HCV-QT, GENOTYPE(SUBSIDIZED)', 'HCV', 9, '4760.00'),
(456, 'HCV RNA Quantitive(Subsidize)', 'HCV QT', 9, '3000.00'),
(457, 'HCV Genotype(Subsidize)', 'HCV Genotype', 9, '4000.00'),
(458, 'Urine Microscopy', 'UM', 8, '60.00'),
(459, 'MTB-PCR', 'MTB', 13, '1900.00'),
(460, 'Dengue', 'Dengue', 1, '1600.00'),
(461, 'Cytology Exam ', 'Cytology', 14, '120.00'),
(462, 'X - Ray Heel Lat/axial', ' Heel ', 3, '350.00'),
(463, 'Dengue IgG/IgM', 'DENGUE', 0, '1600.00'),
(464, 'SCL 70 Antibody', 'SCL', 9, '1300.00'),
(465, 'Troponin T', 'Trop', 15, '730.00'),
(466, 'Wound Culture And Sensitivity', 'Wound C/S', 0, '430.00'),
(467, 'X-Ray Secro Eliac Joint AP/Lat', 'Secro', 3, '350.00'),
(468, 'X-Ray Pariotid Gland', 'Parotic Gland', 3, '250.00'),
(469, 'X-Ray Pariotid Gland', 'Pariotid Gland', 3, '350.00'),
(470, 'CA 19.9', 'CA', 2, '1050.00'),
(471, 'Estrogen', 'Estrogen', 5, '700.00'),
(472, 'Allergy Panel', 'Allergy Panel', 2, '6300.00'),
(473, 'ACHR Antiboby', 'ACHR', 2, '2950.00'),
(474, 'Musk Antiboby', 'Musk', 2, '5000.00'),
(475, 'Urine Albumin', 'Urine Albumin', 8, '40.00'),
(476, 'Anti HbeAg', 'Anti HbeAg', 9, '900.00'),
(477, 'Renal Biopsy For Light Microscopy', 'Light Microscopy', 10, '2000.00'),
(479, 'USG Posterior Cervical Region', 'USG Cervical', 4, '450.00'),
(480, 'Cardiac Marker', 'Cam', 5, '1610.00'),
(481, 'X - Ray Urethrocystogram', 'Urethro', 3, '1200.00'),
(482, 'X - Ray Thigh', 'Thigh', 3, '270.00'),
(483, 'X - Ray T.M. Joint', 'T.M. Joint', 3, '270.00'),
(484, 'X - Ray Soft Tissue Neck', 'Soft Tissue Neck', 3, '270.00'),
(485, 'X - Ray Sinogram', 'Sinogram', 3, '1200.00'),
(486, 'X - Ray Sialogram', 'Sialogram', 3, '1200.00'),
(487, 'X -ray Patella Skyline View', 'Patella Skyline', 3, '270.00'),
(488, 'X- Ray Foot', 'Foot', 3, '270.00'),
(489, 'X- Ray Mandible', 'Mandible', 3, '270.00'),
(490, 'X- Ray Leg', 'Leg', 3, '270.00'),
(491, 'X- Ray Knee Joint', 'Knee Joint', 3, '270.00'),
(492, 'X -Ray Hand ', 'Hand', 3, '270.00'),
(493, 'X -ray Elbow', 'Elbow', 3, '270.00'),
(494, 'X- Ray Fistulogram', 'Fistulogram', 3, '1200.00'),
(495, 'X -ray Forearm', 'Forearm', 3, '270.00'),
(496, 'USG Guided', 'Usg(Guided)', 4, '250.00'),
(497, 'Collection Charge(Endoscopy)', 'Cc', 3, '100.00'),
(498, 'X-Ray PNS Lat.', 'PNS', 3, '270.00'),
(499, 'HIV - RNA 1 (Quantitative) ', 'HIV - RNA 1 (QT)', 2, '4800.00'),
(500, 'HIV - RNA 2 (Quantitative)', 'HIV - RNA 2', 2, '5500.00'),
(501, 'HIV - 1 Drug Resistance Test', 'HIV - 1 Drug Resista', 2, '13900.00'),
(502, 'Acid Phosphatase', 'Acid', 15, '350.00'),
(503, 'Anti RO (SSA)', 'SSA', 0, '1300.00'),
(504, 'Anti LA (SSB)', 'SSB', 0, '1300.00'),
(505, 'ASMA', 'Asma', 2, '1600.00'),
(506, 'Anti-LKM', 'LKM', 2, '1600.00'),
(507, 'Big Toe AP/LAT', 'Toe', 3, '350.00'),
(508, 'USG (Ankle Joint)', 'USG (Ankle Joint)', 4, '450.00'),
(509, 'HEV - IgG/IgM', 'HEV - IgG/IgM', 5, '950.00'),
(510, 'HCV-Genotyping', 'HCV', 10, '3000.00'),
(511, 'HLA- B27', 'HLA', 10, '1900.00'),
(512, 'X - Ray Nasal Bone (Both Lateral)', 'Nasal Bone (Both Lat', 3, '350.00'),
(513, 'HBV-DNA', 'HBV', 9, '3700.00'),
(514, 'USG Kidney Area( One Site)', 'Kidney', 4, '100.00'),
(515, 'USG(Rt. Shoulder & Supra Scapular Area)', 'USG Shoulder', 4, '450.00'),
(516, 'X - Ray Scapula Ap/lat', 'X - Ray Scapula Apl/', 3, '350.00');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE IF NOT EXISTS `user_table` (
  `user_id` int(10) unsigned NOT NULL,
  `user_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_dept_id` tinyint(3) unsigned NOT NULL,
  `user_date` datetime NOT NULL,
  `user_status` tinyint(3) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `user_name`, `user_password`, `name`, `surname`, `user_dept_id`, `user_date`, `user_status`) VALUES
(1, 'super admin', '5f4dcc3b5aa765d61d8327deb882cf99', 'Super Admin', '', 1, '0000-00-00 00:00:00', 1),
(2, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 'ED Admin', 'Hr Dept', 2, '2014-05-15 10:53:08', 1),
(1615, 'user 1', '5f4dcc3b5aa765d61d8327deb882cf99', 'Test', 'Test', 3, '2016-04-06 12:10:30', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_tbl`
--
ALTER TABLE `audit_tbl`
  ADD PRIMARY KEY (`A_id`);

--
-- Indexes for table `card_holder`
--
ALTER TABLE `card_holder`
  ADD PRIMARY KEY (`DH_id`), ADD KEY `DH_patient_id` (`DH_patient_id`), ADD KEY `DH_patient_id_2` (`DH_patient_id`), ADD KEY `DH_validity` (`DH_validity`);

--
-- Indexes for table `card_validity`
--
ALTER TABLE `card_validity`
  ADD PRIMARY KEY (`CV_id`);

--
-- Indexes for table `counter_tbl`
--
ALTER TABLE `counter_tbl`
  ADD PRIMARY KEY (`counter_id`);

--
-- Indexes for table `department_tbl`
--
ALTER TABLE `department_tbl`
  ADD PRIMARY KEY (`department_id`), ADD UNIQUE KEY `department_name` (`department_name`);

--
-- Indexes for table `designation_tbl`
--
ALTER TABLE `designation_tbl`
  ADD PRIMARY KEY (`designation_id`), ADD UNIQUE KEY `designation_name` (`designation_name`);

--
-- Indexes for table `discount_tbl`
--
ALTER TABLE `discount_tbl`
  ADD PRIMARY KEY (`disc_code_sl`);

--
-- Indexes for table `district_tbl`
--
ALTER TABLE `district_tbl`
  ADD PRIMARY KEY (`district_id`), ADD UNIQUE KEY `district_name` (`district_name`);

--
-- Indexes for table `dr_clinic_tbl`
--
ALTER TABLE `dr_clinic_tbl`
  ADD PRIMARY KEY (`DC_id`);

--
-- Indexes for table `dr_cur_address`
--
ALTER TABLE `dr_cur_address`
  ADD PRIMARY KEY (`DCA_id`);

--
-- Indexes for table `dr_family_tbl`
--
ALTER TABLE `dr_family_tbl`
  ADD PRIMARY KEY (`DF_id`);

--
-- Indexes for table `dr_info`
--
ALTER TABLE `dr_info`
  ADD PRIMARY KEY (`dr_id`), ADD UNIQUE KEY `dr_name` (`dr_name`), ADD UNIQUE KEY `dr_name_2` (`dr_name`);

--
-- Indexes for table `dr_profile`
--
ALTER TABLE `dr_profile`
  ADD PRIMARY KEY (`dp_id`);

--
-- Indexes for table `emp_cur_address`
--
ALTER TABLE `emp_cur_address`
  ADD PRIMARY KEY (`ECA_id`), ADD UNIQUE KEY `ECA_ei_id` (`ECA_ei_id`);

--
-- Indexes for table `emp_exit_tbl`
--
ALTER TABLE `emp_exit_tbl`
  ADD PRIMARY KEY (`EE_id`), ADD UNIQUE KEY `EE_ei_id` (`EE_ei_id`);

--
-- Indexes for table `emp_family`
--
ALTER TABLE `emp_family`
  ADD PRIMARY KEY (`EF_id`);

--
-- Indexes for table `emp_info`
--
ALTER TABLE `emp_info`
  ADD PRIMARY KEY (`EI_id`), ADD UNIQUE KEY `EI_name` (`EI_name`);

--
-- Indexes for table `emp_letter`
--
ALTER TABLE `emp_letter`
  ADD PRIMARY KEY (`EL_id`);

--
-- Indexes for table `emp_prev_experience`
--
ALTER TABLE `emp_prev_experience`
  ADD PRIMARY KEY (`PE_id`);

--
-- Indexes for table `emp_qualification`
--
ALTER TABLE `emp_qualification`
  ADD PRIMARY KEY (`emp_qualf_id`);

--
-- Indexes for table `emp_tbl`
--
ALTER TABLE `emp_tbl`
  ADD PRIMARY KEY (`ET_id`);

--
-- Indexes for table `expenditure`
--
ALTER TABLE `expenditure`
  ADD PRIMARY KEY (`EX_id`);

--
-- Indexes for table `gender_tbl`
--
ALTER TABLE `gender_tbl`
  ADD PRIMARY KEY (`gender_id`);

--
-- Indexes for table `lab_note`
--
ALTER TABLE `lab_note`
  ADD PRIMARY KEY (`LB_id`), ADD KEY `LB_user` (`LB_user`), ADD KEY `LB_receipt_no` (`LB_receipt_no`);

--
-- Indexes for table `lab_status`
--
ALTER TABLE `lab_status`
  ADD PRIMARY KEY (`LAB_status_sl`);

--
-- Indexes for table `letter_type_tbl`
--
ALTER TABLE `letter_type_tbl`
  ADD PRIMARY KEY (`letter_type_id`);

--
-- Indexes for table `marital_tbl`
--
ALTER TABLE `marital_tbl`
  ADD PRIMARY KEY (`marital_id`);

--
-- Indexes for table `patient_history`
--
ALTER TABLE `patient_history`
  ADD PRIMARY KEY (`PH_id`), ADD KEY `PH_patient_id` (`PH_patient_id`);

--
-- Indexes for table `patient_info`
--
ALTER TABLE `patient_info`
  ADD PRIMARY KEY (`PI_id`), ADD KEY `PI_name` (`PI_name`);

--
-- Indexes for table `patient_payment`
--
ALTER TABLE `patient_payment`
  ADD PRIMARY KEY (`PP_sl`), ADD KEY `PP_bal` (`PP_bal`), ADD KEY `PP_receipt_no` (`PP_receipt_no`);

--
-- Indexes for table `patient_registration`
--
ALTER TABLE `patient_registration`
  ADD PRIMARY KEY (`pr_receipt_no`), ADD KEY `pr_date` (`pr_date`), ADD KEY `pr_source_id` (`pr_source_id`), ADD KEY `pr_referred_id` (`pr_referred_id`), ADD KEY `pr_status_id` (`pr_status_id`), ADD KEY `pr_dr_prescription` (`pr_dr_prescription`);

--
-- Indexes for table `patient_test`
--
ALTER TABLE `patient_test`
  ADD PRIMARY KEY (`PT_sl`), ADD UNIQUE KEY `PT_sl` (`PT_sl`);

--
-- Indexes for table `patient_transaction`
--
ALTER TABLE `patient_transaction`
  ADD PRIMARY KEY (`TR_id`);

--
-- Indexes for table `pin_tbl`
--
ALTER TABLE `pin_tbl`
  ADD PRIMARY KEY (`pin_id`);

--
-- Indexes for table `price_dump`
--
ALTER TABLE `price_dump`
  ADD PRIMARY KEY (`PD_sl`);

--
-- Indexes for table `price_version`
--
ALTER TABLE `price_version`
  ADD PRIMARY KEY (`PV_id`);

--
-- Indexes for table `referred_tbl`
--
ALTER TABLE `referred_tbl`
  ADD PRIMARY KEY (`referred_id`), ADD UNIQUE KEY `referred_name` (`referred_name`);

--
-- Indexes for table `sample_collection_tbl`
--
ALTER TABLE `sample_collection_tbl`
  ADD PRIMARY KEY (`SC_sl`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `source_tbl`
--
ALTER TABLE `source_tbl`
  ADD PRIMARY KEY (`source_id`), ADD UNIQUE KEY `source_name` (`source_name`);

--
-- Indexes for table `state_tbl`
--
ALTER TABLE `state_tbl`
  ADD PRIMARY KEY (`state_id`), ADD UNIQUE KEY `state_name` (`state_name`);

--
-- Indexes for table `status_tbl`
--
ALTER TABLE `status_tbl`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `tax_tbl`
--
ALTER TABLE `tax_tbl`
  ADD PRIMARY KEY (`TX_id`), ADD UNIQUE KEY `TX_receipt_no` (`TX_receipt_no`);

--
-- Indexes for table `template_body`
--
ALTER TABLE `template_body`
  ADD PRIMARY KEY (`TPB_id`);

--
-- Indexes for table `template_name`
--
ALTER TABLE `template_name`
  ADD PRIMARY KEY (`TPN_id`), ADD UNIQUE KEY `TPN_name` (`TPN_name`), ADD KEY `TPN_name_2` (`TPN_name`), ADD KEY `TPN_name_3` (`TPN_name`);

--
-- Indexes for table `template_value`
--
ALTER TABLE `template_value`
  ADD PRIMARY KEY (`TV_id`), ADD KEY `TV_template_body` (`TV_template_body`), ADD KEY `TV_patient_test` (`TV_patient_test`);

--
-- Indexes for table `test_category`
--
ALTER TABLE `test_category`
  ADD PRIMARY KEY (`test_category_id`), ADD UNIQUE KEY `test_category_name` (`test_category_name`);

--
-- Indexes for table `test_old_price`
--
ALTER TABLE `test_old_price`
  ADD PRIMARY KEY (`OP_id`), ADD KEY `OP_test_id` (`OP_test_id`), ADD KEY `OP_user` (`OP_user`);

--
-- Indexes for table `test_tbl`
--
ALTER TABLE `test_tbl`
  ADD PRIMARY KEY (`test_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `user_id_2` (`user_id`), ADD UNIQUE KEY `user_name` (`user_name`), ADD UNIQUE KEY `username_index` (`user_name`), ADD KEY `user_id` (`user_id`), ADD KEY `user_id_3` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(9) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `template_value`
--
ALTER TABLE `template_value`
ADD CONSTRAINT `fk_tvalue_tbody` FOREIGN KEY (`TV_template_body`) REFERENCES `template_body` (`TPB_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
