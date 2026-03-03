CREATE TABLE IF NOT EXISTS db_table (
    id INT PRIMARY KEY AUTO_INCREMENT,
    text VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO db_table (text)
SELECT 'azerty'
WHERE NOT EXISTS (SELECT 1 FROM db_table WHERE text = 'azerty');

INSERT INTO db_table (text)
SELECT 'abcdef'
WHERE NOT EXISTS (SELECT 1 FROM db_table WHERE text = 'abcdef');

INSERT INTO db_table (text)
SELECT 'xyz'
WHERE NOT EXISTS (SELECT 1 FROM db_table WHERE text = 'xyz');

INSERT INTO db_table (text)
SELECT '123456789'
WHERE NOT EXISTS (SELECT 1 FROM db_table WHERE text = '123456789');
