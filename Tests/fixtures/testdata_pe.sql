# Uncomment this line if you execute SQL manually for MySQL 5
# SET @@session.sql_mode = '';

# Activate en and de languages
UPDATE `oxconfig` SET `OXVARVALUE` = 0x4dba832f744c5786a371d9df33778f9525f408b6efbc82de7c3c5ae3396caa6f8afb6864afa833b43597cad1fb8f9b8970c8e9098d10aae1be4637faa40a012a04e45a8a1cdd1b2ac3da558638600e58acf70fe8c192b668995bb533dac95be7af7d343b3a9c9b8daeaf4d637f065895346773476d667de331fe40d18765d4b98faf7375e1090587d8dd4bf98ad5005eb30666410920 WHERE `OXVARNAME` = 'aLanguageParams';

# Activate all coutries
UPDATE `oxcountry` SET `OXACTIVE` = 1 WHERE `OXISOALPHA2` in ('DE', 'AT', 'CH', 'GB', 'US');

#set country for default user
UPDATE oxuser SET oxcountryid = 'a7c40f631fc920687.20179984' where oxid='oxdefaultadmin';

#
# Data for table `oxactions2article`
#
INSERT INTO `oxactions2article` (`OXID`, `OXSHOPID`, `OXACTIONID`, `OXARTID`, `OXSORT`) VALUES
('95842e9fde5c6f051.82672123', 1, 'oxnewest', '1952', 1),
('95842e9fdd770ecf8.14629724', 1, 'oxnewest', '2024', 0),
('4e542e4e733c1e9c5.78538319', 1, 'oxtopstart', '1849', 0);

#
# Data for table `oxarticles`
#
INSERT INTO `oxarticles` (`OXID`, `OXSHOPID`, `OXPARENTID`, `OXACTIVE`, `OXACTIVEFROM`, `OXACTIVETO`, `OXARTNUM`, `OXEAN`, `OXDISTEAN`, `OXMPN`, `OXTITLE`, `OXSHORTDESC`, `OXPRICE`, `OXBLFIXEDPRICE`, `OXPRICEA`, `OXPRICEB`, `OXPRICEC`, `OXBPRICE`, `OXTPRICE`, `OXUNITNAME`, `OXUNITQUANTITY`, `OXEXTURL`, `OXURLDESC`, `OXURLIMG`, `OXVAT`, `OXTHUMB`, `OXICON`, `OXPIC1`, `OXPIC2`, `OXPIC3`, `OXPIC4`, `OXPIC5`, `OXPIC6`, `OXPIC7`, `OXPIC8`, `OXPIC9`, `OXPIC10`, `OXPIC11`, `OXPIC12`, `OXWEIGHT`, `OXSTOCK`, `OXSTOCKFLAG`, `OXSTOCKTEXT`, `OXNOSTOCKTEXT`, `OXDELIVERY`, `OXINSERT`, `OXTIMESTAMP`, `OXLENGTH`, `OXWIDTH`, `OXHEIGHT`, `OXFILE`, `OXSEARCHKEYS`, `OXTEMPLATE`, `OXQUESTIONEMAIL`, `OXISSEARCH`, `OXISCONFIGURABLE`, `OXVARNAME`, `OXVARSTOCK`, `OXVARCOUNT`, `OXVARSELECT`, `OXVARMINPRICE`, `OXVARMAXPRICE`, `OXVARNAME_1`, `OXVARSELECT_1`, `OXVARNAME_2`, `OXVARSELECT_2`, `OXVARNAME_3`, `OXVARSELECT_3`, `OXTITLE_1`, `OXSHORTDESC_1`, `OXURLDESC_1`, `OXSEARCHKEYS_1`, `OXTITLE_2`, `OXSHORTDESC_2`, `OXURLDESC_2`, `OXSEARCHKEYS_2`, `OXTITLE_3`, `OXSHORTDESC_3`, `OXURLDESC_3`, `OXSEARCHKEYS_3`, `OXBUNDLEID`, `OXFOLDER`, `OXSUBCLASS`, `OXSTOCKTEXT_1`, `OXSTOCKTEXT_2`, `OXSTOCKTEXT_3`, `OXNOSTOCKTEXT_1`, `OXNOSTOCKTEXT_2`, `OXNOSTOCKTEXT_3`, `OXSORT`, `OXSOLDAMOUNT`, `OXNONMATERIAL`, `OXFREESHIPPING`, `OXREMINDACTIVE`, `OXREMINDAMOUNT`, `OXAMITEMID`, `OXAMTASKID`, `OXVENDORID`, `OXMANUFACTURERID`, `OXSKIPDISCOUNTS`, `OXRATING`, `OXRATINGCNT`, `OXMINDELTIME`, `OXMAXDELTIME`, `OXDELTIMEUNIT`, `OXUPDATEPRICE`, `OXUPDATEPRICEA`, `OXUPDATEPRICEB`, `OXUPDATEPRICEC`, `OXUPDATEPRICETIME`, `OXISDOWNLOADABLE`) VALUES
('1952', 1, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1952', '', '', '', 'Hangover Pack LITTLE HELPER', '', 6, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '1952_th.jpg', '1952_ico.jpg',  '1952_p1.jpg', '', '', '', '', '', '', '', '', '', '', '', 0, 22, 1, 'Lieferzeit 1-2 Tage', 'Lieferzeit 1-2 Wochen', '0000-00-00', '2005-07-28', '2010-02-18 17:29:27', 0, 0, 0, '', '', '', '', 1, 0, '', 0, 0, '', 6, 0, '', '', '', '', '', '', 'Hangover Set LITTLE HELPER', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Will be shipped in 24-48 hours', '', '', 'Will be shipped in 7-14 days', '', '', 0, 10, 0, 0, 0, 0, '', '', '', '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '0000-00-00 00:00:00', 0),
('1952_variant_1', 1, '1952', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1952_variant_1', '', '', '', 'Hangover Pack LITTLE HELPER', '', 6, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '1952_th.jpg', '1952_ico.jpg',  '1952_p1.jpg', '', '', '', '', '', '', '', '', '', '', '', 0, 22, 1, 'Lieferzeit 1-2 Tage', 'Lieferzeit 1-2 Wochen', '0000-00-00', '2005-07-28', '2010-02-18 17:29:27', 0, 0, 0, '', '', '', '', 1, 0, '', 0, 0, '', 6, 0, '', '', '', '', '', '', 'Hangover Set LITTLE HELPER', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Will be shipped in 24-48 hours', '', '', 'Will be shipped in 7-14 days', '', '', 0, 10, 0, 0, 0, 0, '', '', '', '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '0000-00-00 00:00:00', 0),
('2024', 1, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2024', '', '', '', 'Popcornschale PINK', '', 11, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2024_th.jpg', '2024_ico.jpg',  '2024_p1.jpg', '', '', '', '', '', '', '', '', '', '', '', 0, 7, 1, 'Lieferzeit 1-2 Tage', 'Lieferzeit 1-2 Wochen', '0000-00-00', '2005-07-28', '2010-02-18 17:29:27', 0, 0, 0, '', '', '', '', 1, 0, '', 0, 0, '', 11, 0, '', '', '', '', '', '', 'Popcorn Bowl PINK', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Will be shipped in 24-48 hours', '', '', 'Will be shipped in 7-14 days', '', '', 0, 20, 0, 0, 0, 0, '', '', '', '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '0000-00-00 00:00:00', 0),
('1849', 1, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1849', '', '', '', 'Bar Butler 6 BOTTLES', '', 89.9, 0, 0, 0, 0, 94, 94, '', 0, '', '', '', NULL, '1849_th.jpg', '1849_ico.jpg',  '1849_p1.jpg', '', '', '', '', '', '', '', '', '', '', '', 0, 6, 1, 'Lieferzeit 1-2 Tage', 'Lieferzeit 1-2 Wochen', '0000-00-00', '2005-07-28', '2010-02-18 17:29:27', 0, 0, 0, '', '', '', '', 1, 0, '', 0, 0, '', 89.9, 0, '', '', '', '', '', '', 'Bar Butler 6 BOTTLES', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Will be shipped in 24-48 hours', '', '', 'Will be shipped in 7-14 days', '', '', 0, 0, 0, 0, 0, 0, '', '', '', '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '0000-00-00 00:00:00', 0);

INSERT INTO `oxartextends` (`OXID`, `OXLONGDESC`, `OXLONGDESC_1`, `OXLONGDESC_2`, `OXLONGDESC_3`) VALUES
('1952', '<div>Erste Hilfe f�r den Morgen danach. Einfach Eis in den Beutel f�llen und ab damit auf das schmerzende Haupt! </div>\r\n<div>&nbsp;</div>\r\n<div>Durchmesser: 20 cm</div>\r\n<div>&nbsp;</div>\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse k�nnen Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span></div>', '<P>First aid for the morning after. Fill ice in the bag and put it to your hurting head.</P>\r\n<P>Measures 7.9 inch</P>\r\n\r\n<P><STRONG><FONT COLOR="#666666">Where to\r\nbuy:</FONT></STRONG><FONT COLOR="#666666"> If you are interested you\r\ncan purchase this product at <A HREF="http://www.desaster.com/">www.desaster.com</A></FONT></P>', '', ''),
('2024', '<div>Riesengro�e pinke Schale im Popcorn-Design. </div>\r\n<div>&nbsp;</div>\r\n<div>Durchmesser: 25,5 cm</div>\r\n<div>&nbsp;</div>\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse k�nnen Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span></div>', '<P>A huge pink bowl in a fancy popcorn design.</P>\r\n<P>Diameter: 10 inches</P>\r\n\r\n<P><STRONG><FONT COLOR="#666666">Where to\r\nbuy:</FONT></STRONG><FONT COLOR="#666666"> If you are interested you\r\ncan purchase this product at <A HREF="http://www.desaster.com/">www.desaster.com</A></FONT></P>', '', ''),
('1849', '<div>F�r 6 Flaschen. </div>\r\n<div>&nbsp;</div>\r\n<div>H�he: 52 cm <br>\r\nMaterial: Chrom</div>\r\n<div>&nbsp;</div>\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse k�nnen Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span></div>', '<P>A bar butler for six bottles.</P>\r\n<P>Height: 20.5 inch<BR>\r\nMaterial: chrome</P>\r\n\r\n<P><STRONG><FONT COLOR="#666666">Where to\r\nbuy:</FONT></STRONG><FONT COLOR="#666666"> If you are interested you\r\ncan purchase this product at <A HREF="http://www.desaster.com/">www.desaster.com</A></FONT></P>', '', '');


#
# Data for table `oxobject2category`
#
INSERT INTO `oxobject2category` (`OXID`, `OXOBJECTID`, `OXCATNID`, `OXPOS`, `OXTIME`) VALUES
('8a142c3e7c2424325.54593359', '1952', '8a142c3e4143562a5.46426637', 1, 1120135167),
('8a142c3e7b36eece1.24875909', '2024', '8a142c3e4143562a5.46426637', 0, 1120135152),
('8a142c3e71b6fb3f6.40220233', '1849', '8a142c3e49b5a80c1.23676990', 0, 1120135000);

INSERT INTO `oxcategories` (`OXID`, `OXPARENTID`, `OXLEFT`, `OXRIGHT`, `OXROOTID`, `OXSORT`, `OXACTIVE`, `OXHIDDEN`, `OXSHOPID`, `OXTITLE`, `OXDESC`, `OXLONGDESC`, `OXTHUMB`, `OXTHUMB_1`, `OXTHUMB_2`, `OXTHUMB_3`, `OXEXTLINK`, `OXTEMPLATE`, `OXDEFSORT`, `OXDEFSORTMODE`, `OXPRICEFROM`, `OXPRICETO`, `OXACTIVE_1`, `OXTITLE_1`, `OXDESC_1`, `OXLONGDESC_1`, `OXACTIVE_2`, `OXTITLE_2`, `OXDESC_2`, `OXLONGDESC_2`, `OXACTIVE_3`, `OXTITLE_3`, `OXDESC_3`, `OXLONGDESC_3`, `OXICON`, `OXPROMOICON`, `OXVAT`, `OXSKIPDISCOUNTS`, `OXSHOWSUFFIX`) VALUES
('8a142c3e4143562a5.46426637', 'oxrootid', 1, 10, '8a142c3e4143562a5.46426637', 9999, 1, 0, 1, 'Geschenke', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Gifts', '', '', 1, '', '', '', 0, '', '', '', '', '', NULL, 0, 1),
('8a142c3e44ea4e714.31136811', '8a142c3e4143562a5.46426637', 2, 5, '8a142c3e4143562a5.46426637', 9999, 1, 0, 1, 'Wohnen', 'Man kann nie zu reich, zu sch�n oder zu m�biliert sein!', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Living', 'You can never be too rich, too pretty, or have too nice furniture!', '', 1, '', '', '', 0, '', '', '', '', '', NULL, 0, 1),
('8a142c3e49b5a80c1.23676990', '8a142c3e4143562a5.46426637', 6, 7, '8a142c3e4143562a5.46426637', 9999, 1, 0, 1, 'Bar-Equipment', 'Stilvoll saufen!', '<div>Hier finden Sie Bar-Equipment f�r Party und private Anl�sse, ebenso wie f�r den professionellen Einsatz.</div>', 'bar_tc.jpg', '', '', '', '', '', '', 0, 0, 0, 1, 'Bar Equipment', 'drink in style', '<div>In this category you will find bar equipment for parties and private occasions as well as for professional use.</div>', 1, '', '', '', 0, '', '', '', '', '', NULL, 0, 1),
('8a142c3e4d3253c95.46563530', '8a142c3e4143562a5.46426637', 8, 9, '8a142c3e4143562a5.46426637', 9999, 1, 0, 1, 'Fantasy', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Fantasy', '', '', 1, '', '', '', 0, '', '', '', '', '', NULL, 0, 1),
('8a142c3e60a535f16.78077188', '8a142c3e44ea4e714.31136811', 3, 4, '8a142c3e4143562a5.46426637', 9999, 1, 0, 1, 'Uhren', '', '', 'uhren3_tc.jpg', '', '', '', '', '', '', 0, 0, 0, 1, 'Clocks', '', '', 1, '', '', '', 0, '', '', '', '', '', NULL, 0, 1);

INSERT INTO `oxmanufacturers` (`OXID`, `OXSHOPID`, `OXACTIVE`, `OXICON`, `OXTITLE`, `OXSHORTDESC`, `OXTITLE_1`, `OXSHORTDESC_1`, `OXTITLE_2`, `OXSHORTDESC_2`, `OXTITLE_3`, `OXSHORTDESC_3`, `OXSHOWSUFFIX`) VALUES
('90a8a18dd0cf0e7aec5238f30e1c6106', 1, 1, 'naish_1_mico.png', 'Naish', '', 'Naish', '', '', '', '', '', 0),
('9434afb379a46d6c141de9c9e5b94fcf', 1, 1, 'logo3_ico.png', 'Kuyichi', 'Eine stilbewusste Marke', 'Kuyichi', 'A style conscious brand', '', '', '', '', 0);

#
# Data for promotions
#

INSERT INTO `oxactions` (`OXID`, `OXSHOPID`, `OXSORT`, `OXTYPE`, `OXTITLE`, `OXTITLE_1`, `OXTITLE_2`, `OXTITLE_3`, `OXLONGDESC`, `OXLONGDESC_1`, `OXLONGDESC_2`, `OXLONGDESC_3`, `OXACTIVE`, `OXACTIVEFROM`, `OXACTIVETO`) VALUES
('d51dbdafb1e51b869f5d8ac233e97814', 1, 2, 2, 'Current Promotion', 'Current Promotion', '', '',   '<a href="[{ oxgetseourl type=\'oxcategory\' oxid=\'8a142c3e60a535f16.78077188\' }]">          <img alt="" src="[{$oViewConf->getPictureDir()}]promo/current_de.jpg" /></a>', '<a href="[{ oxgetseourl type=\'oxcategory\' oxid=\'8a142c3e60a535f16.78077188\' }]">           <img alt="" src="[{$oViewConf->getPictureDir()}]promo/current_en.jpg" /></a>',  '', '', 0, '2010-01-01 00:00:00', '2010-10-10 00:00:00'),
('d51f5e7446e9193188fb315c9d60520a', 1, 1, 2, 'Expired promotion', 'Expired promotion', '', '',   '<a href="[{ oxgetseourl type=\'oxarticle\' oxid=\'1651\' }]">                                 <img alt="" src="[{$oViewConf->getPictureDir()}]promo/expired_de.jpg" /></a>', '<a href="[{ oxgetseourl type=\'oxarticle\' oxid=\'1651\' }]">                                  <img alt="" src="[{$oViewConf->getPictureDir()}]promo/expired_en.jpg" /></a>',  '', '', 0, '2010-01-01 00:00:00', '2010-02-01 00:00:00'),
('d51545e80843be666a9326783a73e91d', 1, 3, 2, 'Upcoming Promotion', 'Upcoming Promotion', '', '', '<a href="[{ oxgetseourl type=\'oxmanufacturer\' oxid=\'9434afb379a46d6c141de9c9e5b94fcf\' }]"><img alt="" src="[{$oViewConf->getPictureDir()}]promo/upcoming_de.jpg" /></a>', '<a href="[{ oxgetseourl type=\'oxmanufacturer\' oxid=\'9434afb379a46d6c141de9c9e5b94fcf\' }]"><img alt="" src="[{$oViewConf->getPictureDir()}]promo/upcoming_en.jpg" /></a>', '', '', 0, '2010-10-10 00:00:00', '2011-10-10 00:00:00');

UPDATE `oxactions` SET OXACTIVE = '1' WHERE OXID='oxstart';


