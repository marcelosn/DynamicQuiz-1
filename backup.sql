-- MySQL dump 10.13  Distrib 5.7.21, for Linux (x86_64)
--
-- Host: localhost    Database: DynamicQuiz
-- ------------------------------------------------------
-- Server version	5.7.21-0ubuntu0.17.10.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classes` (
  `classId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classes`
--

LOCK TABLES `classes` WRITE;
/*!40000 ALTER TABLE `classes` DISABLE KEYS */;
/*!40000 ALTER TABLE `classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `extra_questions`
--

DROP TABLE IF EXISTS `extra_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `extra_questions` (
  `question_num` int(11) NOT NULL AUTO_INCREMENT,
  `question_body` varchar(200) DEFAULT NULL,
  `question_a` varchar(100) DEFAULT NULL,
  `question_b` varchar(100) DEFAULT NULL,
  `question_c` varchar(100) DEFAULT NULL,
  `question_d` varchar(100) DEFAULT NULL,
  `answer` char(10) DEFAULT NULL,
  `catagory` int(3) DEFAULT NULL,
  `hint` varchar(200) DEFAULT NULL,
  `question_e` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`question_num`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `extra_questions`
--

LOCK TABLES `extra_questions` WRITE;
/*!40000 ALTER TABLE `extra_questions` DISABLE KEYS */;
INSERT INTO `extra_questions` VALUES (1,'What is 4+12?','12','15','16','17','3',1,'just add ya mook','20');
/*!40000 ALTER TABLE `extra_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `question_num` int(11) NOT NULL AUTO_INCREMENT,
  `question_body` varchar(400) DEFAULT NULL,
  `question_a` varchar(200) DEFAULT NULL,
  `question_b` varchar(200) DEFAULT NULL,
  `question_c` varchar(200) DEFAULT NULL,
  `question_d` varchar(200) DEFAULT NULL,
  `question_e` varchar(200) DEFAULT NULL,
  `hint` varchar(200) DEFAULT NULL,
  `catagory` varchar(10) DEFAULT NULL,
  `answer` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`question_num`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,'Why might a hashtable be better for storing large amounts of data than an array or linked list?','It isn\'t; arrays are simpler and faster, and linked lists are more flexible','While searches have a longer time complexity in hashtables, they make up for it in low cost insertions and deletions','They are only better if the array is not sorted. ','Hashtables can do searches in constant time without higher costs for insertions and deletions','Hashtables can implement the binary search method','Time complexity is the primary factor here','1','4'),(2,'Why don\'t we simply use direct mapping method?','There may be many more possible values than probable entires','There is a limited amount of digits that an integer type can store','There is a higher chance at collisions between values','All of the above','Answers a and b','A hashing algorithm can produce a smaller integer value out of a larger one or a string','1','5'),(3,'Why do collisions occur?','The key space is larger than the table size','An ineffecient hashing algorithm','The input values are too similar to each other','All of the above','A and B','Collisions are when two inputs map to the same spot in a table. Why might this happen and how are they prevented?','1','5'),(4,'What is the difference between the initial capacity and the load factor?','The initial capacity is the table size, the load factor is the number of elements divided by the table size','The initial capacity is the bit size that a hashing algorithm can process, the load factor is the value given by processing the input to the hash algorithm','The initial capacity is the number of elements divided by table size, a load factor is how many buckets will be added to the table if it passes the initial capacity','The initial capacity is the percentage of the table that can be filled before the table size increases, the load factor is how many buckets will be added to the table if it passes the initial capacity','None of the above','If the number of entries exceeds the load factor, the initial capacity will be used to calculate the increase of buckets','1','1'),(5,'We have a hash value denoted by h() and a table size of 1000. h(1234) = 67. h(3452) = 62. h(1067) = 345. h(34) = 68. Why might this not be a good hash function? ','There are collisions','Not efficiently computable','Not evenly distributed','Not deterministic','All of the above','Study the outputs. Something seem strange?','1','3'),(6,'Is a hashing algorithm without any holes (blank spaces of data in the table) a perfect algorithm?','No--there needs to be blank spaces of data','Yes--that means that every piece of data is distributed evenly','No--there still may be collisions','Yes--That means every input will have a determined output','Answers a and d','Think of a hashing algorithm with a relatively small table size, such as one that stores every word by its first letter. What might occur if an input has at least one word for every letter?','1','3'),(7,'What does it mean for an algorithm to have a collision?','The same input maps to multiple slots in the table','Multiple inputs map to the same slot in the table','Data maps too close together','Different hashing algorithms result in the same distribution','None of the above','Think of a hashing algorithm with a relatively small table size, such as one that stores every word by its first letter. What might occur if an input has at least one word for every letter?','1','2'),(8,'We have a hash function h(), which can process both numerical and alphebetical strings into a table of size 100. h(6784) = 12. h(MST) = 67. h(3000) = -24. h(TOMS) = 99. What is wrong with this algorithm?','It returns a negative value','It is not evenly distributed','There are collisions','It is not deterministic','Answers a and b','How do addresses progress in a table?','1','1'),(9,'Separate chaining solves the collision issue by:','Pointing each slot to a seperate list or tree structure of entries','Implementing an additional computation to move an input to an empty slot','Place collided entries into a seperate, parallel table','Dispose of collided entries','Add additional inputs at the end of the array to account for collided entries','Think of what \'chaining\' refers to','2','1'),(10,'What is not an advantage of seperate chaining?','Flexibility to hash function','Don\'t need to worry about load factors','Simple to implement','Easier and faster searches','All of these are advantages to seperate chaining','Seperate chaining builds linked lists off of buckets in the table. Is there any limit to what can be added? What if something is at the tip of a long chain?','2','4'),(11,'What is the load factor of a seperate chaining algorithm?','The size of the table n--number of slots available','The number of keys stored in a table','Average of keys per bucket','Average of buckets per keys','None of the above','The load factor is a ratio. ','2','3'),(12,'When might it be best to use seperate chaining?','When there will be many collisions on relatively few buckets','When there is not much uniformity within the data','When it is unclear how much uniformity is in the data','A and C','B and C','If there is a lot of data uniformity, there may be long chains off of relatively few buckets. Is this a good thing?','2','5'),(13,'What are some of the weaknesses of separate chaining?','Inserts, deletes, and searches require progressing through a linked list','Worst case time complexity of O(n)','Unused space in table ','Space used to build linked list nodes as seperate structures','All of the Above','Think of the process of seperate chaining--what happens if there is a long list on very few slots?','2','5'),(14,'How does linear probing solve the collision problem?','Hashing the value twice to create a new key','Hashing the first value, then increases an added index by 1 until there is an empty slot','Building an indexed list off of a bucket','Adding 1 every time you hash a value','Using a hash algorithm that adds an integer value to original input','Linear probing will find another place in the table to locate a collided value by performing an operation on the original hash key','3','2'),(15,'We have a hash algorithm for a table of size 9 (buckets in positions of 0, 1, 2, 3, 4, 5, 6, 7, 8). The hash algorithm is f(x) = xmod9. f(18) = 0. f(2) = 2. f(14) = 5. f(30) = 3. Where would f(21) and f(11) go?','3 and 2','4 and 8','3 and 4','4 and 6','3 and 6','Try drawing the table on a piece of scratch paper, and draw how the algorithm moves down the table after collisions.','3','4'),(16,'What are some of the weaknesses of linear probing?','Because you only progress by one each time, it is not very evenly distributed','Removing data will leave holes','A very full table will require many repetitions of the hashing algorithm to find an empty slot','A and B','All of the above','If you have many collisions and each piece of data only progresses by 1, what will that look like on a very large table?','3','5'),(17,'We have a hashing algorithm for a table of size 5 (indexes 0, 1, 2, 3, 4). The hashing algorithm is f(x) = xmod5. It uses linear probing collision resolution. Place the following values: 34, 21, 9, 10, 6. ','4, 1, 0, 2, 3 ','4, 1, 2, 0, 3','3, 4, 0, 2, 1','0, 1, 2, 3, 4','2, 4, 0, 3, 1','Draw out the table. Pay close attention to what happens when a value must index past the end of the table. ','3','1'),(18,'What is a hole in the context of linear probing?','Unused index values between large clumps of data. ','Removed values from a collided data set','Empty indexes that are never hit because of a flaw in the algorithm','The empty slot that the indexed algorithm is hoping to reach after a collision','None of the above','Holes are mostly a problem for searches because they may make values hashed afterwards appear to not exist. Why?','3','2'),(19,'How does quadratic probing solve collisions?','Quadratic probing squares the hash value before adding to it','Quadratic probing multiplies the hash value by the index','Quadratic probing squares the index and adds it to the hashvalue','Quadratic probing adds the index to the hashvalue','Quadratic probing hashes the index and adds it to the hashed value','Linear probing adds the index to the hashed value. ','4','3'),(20,'We have a hash algorithm for a table of size 9 (buckets in positions of 0, 1, 2, 3, 4, 5, 6, 7, 8). It uses quadratic probing collision resolution. The hash algorithm is just the number modded by the size of the table: f(x) = xmod9. f(4) = 4. f(29) = 2. f(12) = 3. f(62) = 8. Where would f(40) and f(47) go?','4 and 2','5 and 7','0 and 1','5 and 6','6 and 7','Draw out the table. Pay close attention to what happens when a value must index past the end of the table. ','4','4'),(21,'What is a problem with quadratic probing?','Reduces the number of slots that can be used','Can result in thrashing','Possibility of holes','A and C','A and B','The indexes are further apart than in linear probing. But does that solve the other issues?','4','4'),(22,'We have a hashing algorithm for a table of size 7 (0, 1, 2, 3, 4, 5, 6). The hashing algorithm is f(x) = (x*2)mod7. It uses quadratic probing collision resolution. Place the following values: 13, 34, 3, 11, 14.','5, 6, 1, 2, 0','6, 0, 1, 4, 5','5, 6, 0, 1, 4','4, 5, 0, 1, 3','5, 6, 0, 1, 3','Draw out the table. Make sure you\'re always adding by the right amounts--the indexes should be squared.','4','3'),(23,'How does double hashing solve the collision problem?','Squaring the result of the hashing algorithm','Adding another hash algorithm multiplied by the index','Adding the index, squaring every time','Adding a second hashing algorithm','Doubling the hashing algorithm added by the index','All open addressing collision resulution algorithms come with the format H(x)+f(x). What is f(x) in this technique, considering the others we\'ve learned about?','5','2'),(24,'We have a hashing algorithm for a table of size 5 (indexes 0, 1, 2, 3, 4). The hashing algorithm is f(x) = xmod5. It uses double hashing collision resolution. The second hashing algorithm is 3-xmod3. hash(11) = 1. hash(6)= 4. hash (32) = 2.  Place the following values: 12, 7. ','0 and 3','0 and 2','2 and 0','2 and 1','4 and 3','They will have a similar result for the first hash algorithm--but not the second. ','5','1'),(25,'What does thrashing refer to in this context?','An algorithm flaw where the double hash value is a factor of the table size','An algorithm flaw where the double hash returns values that are too small, causing the data to cluster much like linear probing','A situation where the double hash will keep hitting the same slots without finding an empty value','A and C','A and B','Thrashing results in a double hash that always adds the same amount to the hash value','5','4'),(26,'Why is it best for all tables in hashing algorithms to be the size of a prime number?','It will prevent thrashing','It will allow for easier distribution of results','The second hash value can\'t be a factor of the table','All of the above','None of the above','Might these reasons be related?','5','5'),(27,'We have a hashing algorithm for a table of size 11 (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10). The hashing algorithm is (x*2)mod11. It uses double hashing collision resolution, and the second hashing algorithm is 7-xmod7. Place the following numbers: 3, 11, 22, 45, 14. ','5, 0, 1, 2, 9','5, 0, 6, 2, 9','5, 10, 1, 6, 9','6, 0, 7, 2, 9','None of the above','Remember to multiply the index by the second hash. ','5','2'),(28,'We have a hashing algorithm of a table of size 9 (0, 1, 2, 3, 4, 5, 6, 7, 8). Our hash algorithm is xmod9. It uses a double hashing technique, with the second hash algoithm being 3-xmod3. Place the following values: 6, 12, 36, 17, 21. ','6, 3, 0, 8, 4','6, 3, 4, 8, 0','0, 3, 6, 8, 1','It will start thrashing','None of the above','Is there something wrong with the second hashing algorithm? ','5','4');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `results`
--

DROP TABLE IF EXISTS `results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `results` (
  `id` int(11) DEFAULT NULL,
  `catagory` int(3) DEFAULT NULL,
  `correct` double(5,2) DEFAULT NULL,
  `wrong` int(11) DEFAULT NULL,
  `hintsUsed` int(11) DEFAULT NULL,
  `catQuestions` int(11) DEFAULT NULL,
  `timesubmitted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `results`
--

LOCK TABLES `results` WRITE;
/*!40000 ALTER TABLE `results` DISABLE KEYS */;
INSERT INTO `results` VALUES (101,0,1.00,NULL,0,NULL,NULL),(101,0,1.00,NULL,0,NULL,NULL),(101,1,1.00,0,0,NULL,'2018-03-20 15:38:36'),(101,1,1.00,0,0,NULL,'2018-03-20 16:22:58'),(101,2,1.00,0,0,NULL,'2018-03-20 16:23:29'),(101,1,1.00,0,0,1,'2018-03-20 16:26:28'),(101,2,1.00,0,0,1,'2018-03-20 16:27:36'),(101,1,1.00,0,0,1,'2018-03-21 03:57:07'),(101,2,1.00,0,0,1,'2018-03-21 03:57:10'),(101,1,1.00,0,0,1,'2018-03-21 03:57:57'),(101,2,1.00,0,0,1,'2018-03-21 03:58:01'),(101,1,1.00,0,0,1,'2018-03-21 03:59:25'),(101,2,1.00,0,0,1,'2018-03-21 03:59:31'),(101,1,1.00,0,0,1,'2018-03-21 17:46:38'),(101,1,1.00,0,0,1,'2018-03-21 17:53:29'),(101,1,1.00,0,1,1,'2018-03-21 18:33:25'),(101,2,1.00,0,0,1,'2018-03-21 18:33:37'),(101,1,1.00,0,0,1,'2018-03-21 18:36:44'),(101,1,1.00,0,0,1,'2018-03-21 18:36:55'),(101,2,0.00,1,0,1,'2018-03-21 18:37:05'),(101,1,1.00,0,0,1,'2018-03-21 18:38:31'),(101,1,1.00,0,0,1,'2018-03-21 18:39:09'),(101,1,1.00,0,0,1,'2018-03-21 18:45:10'),(101,1,1.00,1,1,2,'2018-03-21 18:52:19'),(101,1,1.00,0,1,1,'2018-03-21 20:58:43'),(101,2,1.00,0,1,1,'2018-03-21 20:58:56'),(101,1,1.00,0,0,1,'2018-03-21 20:59:49'),(101,2,1.00,0,0,1,'2018-03-21 20:59:55'),(101,1,1.00,0,0,1,'2018-03-21 21:01:22'),(101,2,1.00,0,0,1,'2018-03-21 21:01:29'),(101,1,1.00,0,0,1,'2018-03-21 21:04:56'),(101,2,1.00,0,0,1,'2018-03-21 21:05:02'),(102,1,2.00,0,0,2,'2018-03-21 23:22:15'),(102,1,1.00,1,0,2,'2018-04-09 01:37:43'),(102,2,1.00,0,0,1,'2018-04-09 01:37:54'),(102,1,1.00,1,0,2,'2018-04-09 01:42:41'),(102,2,1.00,0,0,1,'2018-04-09 01:44:39'),(102,1,2.00,0,0,2,'2018-04-09 01:44:59'),(102,1,2.00,0,1,2,'2018-04-09 01:45:42'),(102,1,2.00,0,0,2,'2018-04-09 01:46:59'),(102,2,1.00,0,0,1,'2018-04-09 01:47:16'),(102,1,1.00,1,0,2,'2018-04-09 01:48:34'),(102,2,1.00,0,0,1,'2018-04-09 01:48:53'),(102,1,2.00,0,0,2,'2018-04-09 01:51:32'),(102,2,1.00,0,0,1,'2018-04-09 01:51:39'),(102,1,2.00,0,0,2,'2018-04-09 01:52:47'),(102,1,2.00,0,0,2,'2018-04-09 01:54:33'),(102,1,2.00,0,0,2,'2018-04-09 01:57:06'),(102,2,1.00,0,0,1,'2018-04-09 01:57:24'),(101,1,1.00,0,0,1,'2018-04-09 16:25:53'),(101,2,1.00,0,0,1,'2018-04-09 16:26:04'),(101,1,1.00,0,0,1,'2018-04-09 16:30:03'),(101,2,1.00,0,0,1,'2018-04-09 16:30:10'),(101,1,1.00,0,0,1,'2018-04-09 17:20:12'),(101,1,1.00,0,0,1,'2018-04-10 21:59:53'),(101,1,1.00,0,0,1,'2018-04-11 01:19:38'),(101,2,1.00,0,0,1,'2018-04-11 01:20:10'),(101,3,1.00,0,0,1,'2018-04-11 01:20:50'),(101,4,1.00,0,0,1,'2018-04-11 01:21:09'),(101,5,1.00,0,0,1,'2018-04-11 01:21:35'),(101,1,1.00,0,0,1,'2018-04-11 12:27:09'),(101,2,1.00,0,0,1,'2018-04-11 12:27:15'),(101,1,3.00,0,2,3,'2018-04-11 12:29:22'),(101,2,1.00,0,0,1,'2018-04-11 12:29:28'),(101,3,1.00,0,0,1,'2018-04-11 12:29:43'),(101,4,1.00,0,0,1,'2018-04-11 12:30:00'),(101,5,1.00,0,0,1,'2018-04-11 12:30:13'),(101,1,1.00,0,0,1,'2018-04-13 14:17:46'),(101,2,2.00,2,0,4,'2018-04-13 14:19:10');
/*!40000 ALTER TABLE `results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `studentlist`
--

DROP TABLE IF EXISTS `studentlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `studentlist` (
  `id` int(11) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `studentgroup` int(11) DEFAULT NULL,
  `number` int(100) NOT NULL AUTO_INCREMENT,
  `activated` int(10) DEFAULT NULL,
  PRIMARY KEY (`number`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studentlist`
--

LOCK TABLES `studentlist` WRITE;
/*!40000 ALTER TABLE `studentlist` DISABLE KEYS */;
INSERT INTO `studentlist` VALUES (101,'harleyquinn',0,1,NULL),(102,'clarkkent',1,2,NULL);
/*!40000 ALTER TABLE `studentlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `videos` (
  `catagory` int(3) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `catName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videos`
--

LOCK TABLES `videos` WRITE;
/*!40000 ALTER TABLE `videos` DISABLE KEYS */;
INSERT INTO `videos` VALUES (1,'https://www.youtube.com/embed/wWgIAphfn2U','Intro To Hashing'),(2,'https://www.youtube.com/embed/_xA8UvfOGgU','Seperate Chaining'),(3,'https://www.youtube.com/embed/tWejo5iIhRw','Linear Probing'),(4,'https://www.youtube.com/embed/SUSXoVmfJJY','Quadratic Probing'),(5,'https://www.youtube.com/embed/K49urTfB27w','Double Hashing');
/*!40000 ALTER TABLE `videos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-13 14:25:26
