import smtplib
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText
from flask import Flask, request, jsonify
from flask_cors import CORS
from dotenv import load_dotenv
import os

# Cargar las variables de entorno desde el archivo .env
load_dotenv()

app = Flask(__name__)
CORS(app, resources={r"/*": {"origins": "*"}})

@app.route('/sucess_email', methods=['POST'])
def send_email():
    destinatario = "barajasvazquezvictorgael@gmail.com"

    # Configuración del servidor
    smtp_server = "smtp.gmail.com"
    smtp_port = 587
    smtp_user = os.getenv('SMTP_USER')
    smtp_password = os.getenv('SMTP_PASSWORD')

    # Crear el mensaje
    email_msg = MIMEMultipart()
    email_msg['From'] = smtp_user
    email_msg['To'] = destinatario  # Usar el correo ingresado en el formulario
    email_msg['Subject'] = "Confirmación de Pago Exitoso"

    body = """
    <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
            }
            .container {
                width: 100%;
                padding: 20px;
                background-color: #ffffff;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                margin: 20px auto;
                max-width: 600px;
            }
            .header {
                background-color: #007BFF;
                color: white;
                padding: 10px 0;
                text-align: center;
                border-radius: 10px 10px 0 0;
            }
            .content {
                padding: 20px;
            }
            .footer {
                text-align: center;
                padding: 10px 0;
                color: #888888;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h2>Confirmación de Pago Exitoso</h2>
            </div>
            <div class="content">
                <p>Su pago ha sido procesado exitosamente. Gracias por su compra.</p>
            </div>
            <div class="footer">
                <p>Este es un mensaje automático de su sitio web.</p>
            </div>
        </div>
    </body>
    </html>
    """
    email_msg.attach(MIMEText(body, 'html'))

    try:
        server = smtplib.SMTP(smtp_server, smtp_port)
        server.starttls()
        server.login(smtp_user, smtp_password)
        server.send_message(email_msg)
        server.quit()
        return jsonify({"message": "Mensaje enviado exitosamente."}), 200
    except Exception as e:
        error_message = str(e)
        print(f"Error al enviar el correo: {error_message}")
        return jsonify({"message": f"Hubo un error al enviar el mensaje: {error_message}"}), 500

if __name__ == "__main__":
    app.run(debug=True, host='0.0.0.0', port=5000)
