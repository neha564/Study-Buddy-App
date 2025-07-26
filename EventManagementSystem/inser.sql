-- Insert data into bookings table
INSERT INTO bookings (event_name, venue, date, start_time, end_time, details, user_name, user_email, user_phone, videography, photography)
VALUES
    ('concert', 'Delhi', '2024-2-15', '11:00:00', '12:00:00', 'Music', 'Pilips', 'pilips@gmail.com', '7989043259', 1, 1),
    ('Birthday', 'Medak', '2024-3-20', '13:00:00', '18:00:00', 'none', 'kavitha', 'kavii@gmail.com', '8765432011', 0, 1),
    ('Aniversary', 'Hyderabad', '2024-4-25', '08:00:00', '12:00:00', 'Silver Juble', 'chandhu ', 'chandu@gmail.com', '9112334455', 1, 0);

-- Insert data into payments table (associating payments with bookings)
-- Assuming the last inserted booking id for Sample Event 1 is 1, and so on

INSERT INTO payments (booking_id, payment_method, payment_status, payment_amount, payment_date)
VALUES
    (1, 'Credit Card', 'Completed', 250000, '2024-2-05'),
    (2, 'Bank Transfer', 'completed', 10000, '2024-3-16'),
    (3, 'Cash', 'compelted', 13000, '2024-4-27');

-- Verify by selecting data from both tables
SELECT * FROM bookings;
SELECT * FROM payments;

