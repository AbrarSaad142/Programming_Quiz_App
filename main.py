from flask import Flask, flash, render_template, request, redirect, session, url_for
from flask_mysqldb import MySQL
import MySQLdb.cursors
from werkzeug.security import generate_password_hash, check_password_hash

import re

app = Flask(__name__)
app.secret_key = "wGH\x01\x08\xca\x01\x80]\xdc\x86\xc6[\xf6\xf3\xc4cpNyX\xe9j\x8f"
app.config["MYSQL_HOST"] = "localhost"
app.config["MYSQL_USER"] = "root"
app.config["MYSQL_PASSWORD"] = "root"
app.config["MYSQL_DB"] = "quiz_app_users"

mysql = MySQL(app)


@app.route("/register", methods=["GET", "POST"])
def register():
    if request.method == "POST":
        firstname = request.form.get("firstname")
        lastname = request.form.get("lastname")
        email = request.form.get("email")
        password = request.form.get("password")
        hashed_password = generate_password_hash(password)

        cursor = mysql.connection.cursor(MySQLdb.cursors.DictCursor)

        if not re.match(r"[^@]+@[^@]+\.[^@]+", email):
            flash("Invalid email address!", "error")
        elif not firstname or not lastname or not password or not email:
            flash("Please fill out the form!", "error")
        else:
            cursor.execute("SELECT * FROM user WHERE email = %s", (email,))
            account = cursor.fetchone()
            if account:
                flash("Account already exists!", "error")
            else:
                try:
                    cursor.execute(
                        "INSERT INTO user (firstname, lastname, email, password) VALUES (%s, %s, %s, %s)",
                        (firstname, lastname, email, hashed_password),
                    )
                    mysql.connection.commit()
                    flash("You have successfully registered!", "success")
                    return redirect(url_for('quiz'))  # Redirect to quiz page
                except Exception as e:
                    flash("An error occurred during registration. Please try again.", "error")
                    print(e)

    return render_template("index-page.html") 

@app.route("/quiz")
def quiz():
    return render_template("quiz-page.html")


if __name__ in "__main__":
    app.run(debug=True)
