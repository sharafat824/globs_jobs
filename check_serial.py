import serial
import time
import requests

# Set up serial communication with your GSM/GPRS module
ser = serial.Serial('/dev/ttyS0', baudrate=9600, timeout=1)

# Function to send AT command and get response
def send_at_command(command):
    ser.write((command + '\r\n').encode())
    time.sleep(1)
    response = ser.read_all().decode()
    return response

# Check if the module is ready
response = send_at_command('AT')
if 'OK' not in response:
    print('Error: Module not responding.')
    ser.close()
    exit()

# Set APN (Access Point Name) - Replace with your carrier's APN
send_at_command('AT+CGDCONT=1,"IP","your_apn_here"')

# Activate PDP context
send_at_command('AT+CGACT=1,1')

# Perform HTTP POST using the requests library
url = 'http://example.com/api'
data = {'key1': 'value1', 'key2': 'value2'}
response = requests.post(url, data=data)

print('HTTP POST Response:', response.text)

# Deactivate PDP context
send_at_command('AT+CGACT=0,1')

# Close serial port
ser.close()
