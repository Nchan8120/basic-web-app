USE assign2db;
-- Part 1 SQL Updates
-- User Image
SELECT * FROM user;
UPDATE user
SET image = 'https://pngimg.com/uploads/simpsons/simpsons_PNG27.png'
WHERE firstname = 'Homer';

-- Post Date
SELECT * FROM post;
UPDATE post
JOIN user ON post.userid = user.userid
SET postdate = '2020-08-24'
WHERE user.lastname = 'Bing';

-- Check Tables
SELECT * FROM user;
SELECT * FROM post;

-- Part 2 SQL Inserts
-- New User
INSERT INTO user (userid, firstname, lastname, image)
VALUES ('wwhite1', 'Walter', 'White', NULL);

-- New Post
INSERT INTO post (postid, posttext, postdate, image, userid)
VALUES ('213', 'Say my name.', '2022-03-09', NULL, 'wwhite1');

-- New Hashtag
INSERT INTO hashtag (hashtagid, hashtagtext, trending, hashtagdate) 
VALUES ('011', '#goodtimes', 0, '2023-11-06');

-- Associate Hashtag with Post
INSERT INTO hashonpost (hashtagid, postid) 
VALUES ('011', '300');
INSERT INTO hashonpost (hashtagid, postid) 
VALUES ('011', '201');
INSERT INTO hashonpost (hashtagid, postid) 
VALUES ('011', '202');

-- Check Tables
SELECT * FROM user;
SELECT * FROM post;
SELECT * FROM hashtag;
SELECT * FROM hashonpost;

-- Part 3 SQL Queries
-- Query 1
SELECT lastname FROM user;
-- Query 2
SELECT DISTINCT lastname FROM user;
-- Query 3
SELECT * FROM user ORDER BY lastname ASC;
-- Query 4
SELECT hashtagtext, hashtagdate FROM hashtag WHERE trending='1';
-- Query 5
SELECT p.postid, p.posttext, u.userid, u.firstname FROM post p JOIN user u ON p.userid = u.userid;
-- Query 6
SELECT h.hashtagtext, p.posttext FROM hashtag h JOIN hashonpost hp ON h.hashtagid = hp.hashtagid
JOIN post p ON hp.postid = p.postid ORDER BY h.hashtagtext;
-- Query 7
SELECT h.hashtagtext, p.posttext, u.firstname, u.lastname FROM hashtag h JOIN hashonpost hp ON h.hashtagid = hp.hashtagid
JOIN post p ON hp.postid = p.postid
JOIN user u ON p.userid = u.userid
WHERE h.hashtagtext IN ('#PositiveVibes', '#BeYourself');
-- Query 8
SELECT p.posttext, c.commenttext, pc.firstname AS poster_firstname, pc.lastname 
AS poster_lastname, cc.firstname AS commenter_firstname, cc.lastname AS commenter_lastname
FROM post p
JOIN user pc ON p.userid = pc.userid
JOIN comments c ON p.postid = c.postid
JOIN user cc ON c.userid = cc.userid
WHERE pc.firstname = 'Chandler' AND pc.lastname = 'Bing';
-- Query 9
SELECT * FROM hashtag h
LEFT JOIN hashonpost hp ON h.hashtagid = hp.hashtagid
WHERE h.trending = '1' AND hp.hashtagid IS NULL;
-- Query 10
SELECT u.firstname, u.lastname, p.posttext, p.postid, COUNT(c.postid) AS num_comments
FROM post p 
JOIN user u ON p.userid = u.userid
JOIN comments c ON p.postid = c.postid
GROUP BY u.firstname, u.lastname, p.posttext, p.postid
HAVING num_comments >= 1;
-- Query 11
SELECT p.posttext, c.commenttext, p.postdate, c.commentdate
FROM post p
JOIN comments c ON p.postid = c.postid
WHERE p.postdate > c.commentdate;
-- Query 12
SELECT u.firstname, u.lastname, u.userid, COUNT(f.follower) AS FollowedBy
FROM user u
LEFT JOIN follows f ON u.userid = f.following
GROUP BY u.firstname, u.lastname, u.userid
ORDER BY FollowedBy DESC;
-- Query 13
CREATE VIEW PostCommmentCounts AS
SELECT p.postid, COUNT(c.postid) AS num
FROM post p
LEFT JOIN comments c ON p.postid = c.postid
GROUP BY p.postid;
SELECT u.firstname, u.lastname, p.posttext, p.postid, pc.num AS num_comments
FROM user u
JOIN post p ON u.userid =  p.userid
JOIN PostCommentCounts pc ON p.postid = pc.postid
WHERE pc.num =(SELECT MAX(num) FROM PostCommentCounts);
-- Query 14
SELECT u.firstname, u.lastname, u.userid, MIN(f.followyear) AS first_follow_year
FROM user u
JOIN follows f ON u.userid = f.follower
GROUP BY u.firstname, u.lastname, u.userid
ORDER BY first_follow_year
LIMIT 1;
-- Query 15
-- Query to retrieve the most popular hashtags along with the number of posts associated with each hashtag.
SELECT h.hashtagtext, COUNT(hp.postid) AS num_posts
FROM hashtag h
LEFT JOIN hashonpost hp ON h.hashtagid = hp.hashtagid
GROUP BY h.hashtagtext
ORDER BY num_posts DESC;

-- Part 4 SQL Views/Deletes
-- Create a View
CREATE VIEW FollowersList AS
SELECT followed.userid AS followed_userid, 
       followed.firstname AS followed_firstname, 
       followed.lastname AS followed_lastname, 
       follower.userid AS follower_userid, 
       follower.firstname AS follower_firstname, 
       follower.lastname AS follower_lastname
FROM user AS followed
LEFT JOIN follows ON followed.userid = follows.following
LEFT JOIN user AS follower ON follows.follower = follower.userid
ORDER BY followed.lastname;

-- Prove it works
SELECT * FROM FollowersList;

-- Show user table
SELECT * FROM user;

-- Delete user
DELETE FROM user WHERE userid = 'nflan';

-- Prove its deleted
SELECT * FROM user WHERE userid = 'nflan';

-- Number of post
SELECT COUNT(*) AS num_posts FROM post;

-- Delete user
DELETE FROM user WHERE userid = 'mgell';

-- Show posts again
SELECT COUNT(*) AS num_posts FROM post;
-- The post associated with the user 'mgell' were deleted because of a foreign key constraint. The post table
-- refernces the user table on the userid column. When a user is deleted, any posts associated with that user
-- are deleted to maintian referential integrity.
