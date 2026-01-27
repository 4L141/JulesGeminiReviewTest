import mysql.connector

def connect_to_database():
    mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
    )
    return mydb

def create_database():
    mydb = connect_to_database()
    mycursor = mydb.cursor()
    mycursor.execute("CREATE DATABASE IF NOT EXISTS RolsaTechnologies")
    mydb.commit()
    mycursor.close()
    mydb.close()

def create_tables():
    mydb = connect_to_database()
    mycursor = mydb.cursor()

    mycursor.execute("SET FOREIGN_KEY_CHECKS = 0")
    mycursor.execute("USE RolsaTechnologies")

    mycursor.execute("DROP TABLE IF EXISTS users")
    mycursor.execute("""
    CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(255),
        last_name VARCHAR(255),
        username VARCHAR(255) UNIQUE,
        email VARCHAR(255) UNIQUE,
        phone VARCHAR(255),
        password VARCHAR(255),
        role VARCHAR(50) DEFAULT 'user',
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )
    """)

    mycursor.execute("DROP TABLE IF EXISTS products")
    mycursor.execute("""
    CREATE TABLE products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255),
        quantity INT,
        description TEXT
    )
    """)

    mycursor.execute("DROP TABLE IF EXISTS schedules")
    mycursor.execute("""
    CREATE TABLE schedules (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        service ENUM('INSTALLATION', 'CONSULTATION'),
        schedule_date DATETIME,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id)
    )
    """)

    mycursor.execute("DROP TABLE IF EXISTS energy_usage")
    mycursor.execute("""
    CREATE TABLE energy_usage (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        product_id INT,
        total_kwh FLOAT,
        cost FLOAT,
        calc_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id),
        FOREIGN KEY (product_id) REFERENCES products(id)
    )
    """)


    mycursor.execute("DROP TABLE IF EXISTS carbon_usage")
    mycursor.execute("""
    CREATE TABLE carbon_usage (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        energy_id INT,
        co2_kg FLOAT,
        calc_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id),
        FOREIGN KEY (energy_id) REFERENCES energy_usage(id)
    )
    """)

    mycursor.execute("SET FOREIGN_KEY_CHECKS = 1")

    mydb.commit()
    mycursor.close()
    mydb.close()

create_database()
create_tables()
print("Tables created successfully")