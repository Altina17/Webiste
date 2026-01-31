CREATE DATABASE IF NOT EXISTS music_events;
USE music_events;

CREATE TABLE IF NOT EXISTS events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    location VARCHAR(100) NOT NULL,
    event_date DATE NOT NULL,
    category VARCHAR(50) NOT NULL,
    image VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO events (title, location, event_date, category, image) VALUES
('Summer Beats Festival', 'Berlin, Germany', '2025-07-20', 'Electronic', 'pic10.jpg'),
('Live Rock Night', 'London, UK', '2025-08-03', 'Rock', 'pic11.jpg'),
('Midnight Club Session', 'Amsterdam, NL', '2025-06-14', 'Techno', 'pic12.jpg'),
('Exclusive DJ Night', 'Paris, France', '2025-09-01', 'House', 'pic13.jpg'),
('Open Air Sunset', 'Barcelona, Spain', '2025-07-28', 'Deep House', 'pic14.jpg'),
('Historic Venue Live', 'Rome, Italy', '2025-08-16', 'Indie', 'pic15.jpg');

CREATE TABLE IF NOT EXISTS tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_id INT NOT NULL,
    user_name VARCHAR(100) NOT NULL,
    user_email VARCHAR(100) NOT NULL,
    quantity INT NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (event_id) REFERENCES events(id)
);
