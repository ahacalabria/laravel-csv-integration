# laravel-csv-integration

Considering this backend challenge: to create a Laravel project(I used the latest version) based on Ordering/Payments of a "meta-e-commerce" platform context in order to develop two features. Mysql is the database

The feature are:
● It should receive orders coming from the e-commerce platform
● It should relay these orders to the integrated partner e-commerce

The first challenge is:
<h3>Partner 1 integration ID "1"</h3>

Partner 1 system has a REST API, and it expects a POST request with JSON data. Their system URL for posting orders is `https://partner1.example.net/api/v1/orders`.

First, once in this challenge time matters, I would choose to develop only the next part of the challenge. So, if I had more time to do this, I would code a OrderSentAction just to get a order ass parameter and sent it as a Post request to the expected endpoint.

About Model classes and migrations, there were created for the part 2.

<h3> Partner 2 Integration ID "2" </h3>
Partner 2 system pulls CSV order files from an SFTP folder. You're expected to send your orders as CSV files, and place them under the `Orders/` folder, using SFTP.

To SFTP works configs on `.env` file must be filled out. The keys are: 
- SFTP_HOST
- SFTP_PORT
- SFTP_USERNAME
- SFTP_PASSWORD
- SFTP_ROOT
- SFTP_TIMEOUT

With this configured it should works. 

Testing
A single unit test were created as a sample to check if the GenerateCSV feature is working.

Adapter design was the pattern used in this feature. A interface CsvGeneratorInterface was created to be implemented on services, such as OrderService that will process and generate the expected csv files. This function needs a list of orders (simple as can be) and it will create the csv file following the specs.

Finally to create a daily process a Job were created in order to be executed daily. This job this instantiate and call the OrderService.

Disclaimer:
If I had more time I could create a control structure to monitor which orders were already converted as array/csv or just made a simple were to get only the order created in the current date. More tests would also be important to accomplish real coverage of the code. All thinking of it as a big massive system that has to show quality of code and coverage.
