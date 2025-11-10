-- Dummy Donor Data for Blood Bank System
-- Insert 10 sample donors with complete details including location and donation history

USE blood_donation;

-- Donor 1: A+ Male, Kathmandu
INSERT INTO donor_details (donor_name, donor_number, donor_mail, donor_age, donor_gender, donor_blood, donor_address, latitude, longitude, last_donation_date, availability_score)
VALUES ('Rajesh Kumar Shrestha', '9841234567', 'rajesh.shrestha@email.com', 28, 'Male', 'A+', 'Thamel, Kathmandu', 27.7172, 85.3240, '2024-08-15', 8);

-- Donor 2: O+ Female, Lalitpur
INSERT INTO donor_details (donor_name, donor_number, donor_mail, donor_age, donor_gender, donor_blood, donor_address, latitude, longitude, last_donation_date, availability_score)
VALUES ('Sita Maharjan', '9852345678', 'sita.maharjan@email.com', 32, 'Female', 'O+', 'Patan, Lalitpur', 27.6783, 85.3244, '2024-09-20', 9);

-- Donor 3: B+ Male, Bhaktapur
INSERT INTO donor_details (donor_name, donor_number, donor_mail, donor_age, donor_gender, donor_blood, donor_address, latitude, longitude, last_donation_date, availability_score)
VALUES ('Bikash Tamang', '9863456789', 'bikash.tamang@email.com', 25, 'Male', 'B+', 'Bhaktapur Durbar Square, Bhaktapur', 27.6710, 85.4298, '2024-10-05', 7);

-- Donor 4: AB+ Female, Kathmandu
INSERT INTO donor_details (donor_name, donor_number, donor_mail, donor_age, donor_gender, donor_blood, donor_address, latitude, longitude, last_donation_date, availability_score)
VALUES ('Priya Thapa', '9874567890', 'priya.thapa@email.com', 29, 'Female', 'AB+', 'Baneshwor, Kathmandu', 27.7008, 85.3001, '2024-07-10', 6);

-- Donor 5: O- Male, Kathmandu
INSERT INTO donor_details (donor_name, donor_number, donor_mail, donor_age, donor_gender, donor_blood, donor_address, latitude, longitude, last_donation_date, availability_score)
VALUES ('Amit Gurung', '9885678901', 'amit.gurung@email.com', 35, 'Male', 'O-', 'New Baneshwor, Kathmandu', 27.7020, 85.3020, '2024-11-12', 10);

-- Donor 6: A- Female, Lalitpur
INSERT INTO donor_details (donor_name, donor_number, donor_mail, donor_age, donor_gender, donor_blood, donor_address, latitude, longitude, last_donation_date, availability_score)
VALUES ('Anita Basnet', '9896789012', 'anita.basnet@email.com', 27, 'Female', 'A-', 'Jawalakhel, Lalitpur', 27.6667, 85.3167, '2024-06-18', 5);

-- Donor 7: B- Male, Kathmandu
INSERT INTO donor_details (donor_name, donor_number, donor_mail, donor_age, donor_gender, donor_blood, donor_address, latitude, longitude, last_donation_date, availability_score)
VALUES ('Niraj Pradhan', '9807890123', 'niraj.pradhan@email.com', 31, 'Male', 'B-', 'Koteshwor, Kathmandu', 27.6789, 85.3456, '2024-09-25', 8);

-- Donor 8: AB- Female, Bhaktapur
INSERT INTO donor_details (donor_name, donor_number, donor_mail, donor_age, donor_gender, donor_blood, donor_address, latitude, longitude, last_donation_date, availability_score)
VALUES ('Sunita Lama', '9818901234', 'sunita.lama@email.com', 24, 'Female', 'AB-', 'Suryabinayak, Bhaktapur', 27.6500, 85.4000, '2024-05-30', 4);

-- Donor 9: O+ Male, Kathmandu
INSERT INTO donor_details (donor_name, donor_number, donor_mail, donor_age, donor_gender, donor_blood, donor_address, latitude, longitude, last_donation_date, availability_score)
VALUES ('Deepak Rai', '9829012345', 'deepak.rai@email.com', 33, 'Male', 'O+', 'Kalimati, Kathmandu', 27.7100, 85.3100, '2024-10-28', 9);

-- Donor 10: A+ Female, Lalitpur
INSERT INTO donor_details (donor_name, donor_number, donor_mail, donor_age, donor_gender, donor_blood, donor_address, latitude, longitude, last_donation_date, availability_score)
VALUES ('Rashmi Karki', '9830123456', 'rashmi.karki@email.com', 26, 'Female', 'A+', 'Lagankhel, Lalitpur', 27.6800, 85.3200, '2024-08-22', 7);

-- Summary of inserted donors:
-- Blood Groups: A+ (2), O+ (2), B+ (1), AB+ (1), O- (1), A- (1), B- (1), AB- (1)
-- Gender: Male (5), Female (5)
-- Age Range: 24-35 years
-- Locations: Kathmandu (5), Lalitpur (3), Bhaktapur (2)
-- All donors have location coordinates and last donation dates for kNN algorithm

