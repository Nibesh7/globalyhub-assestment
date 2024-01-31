# Front End 
For front end design smiple bootstrap table and modal has been used. Similarly, bootsrap form is used to take the user's input 
# Validation
1. Name, Email, Address and Phone cannot be Empty
2. Phone number does not accept any charaters.

## Plugins 
1. For any sorts of alert message vue-toast has been used
2. No any plugins used for Validation purpose
3. Axios has been used to send and retrieve data.


# Backend

## Store Data
1. Validate field Name, Email, Address and Phone.
2. Check if the there is any previous data in file.
3. If there is revious data then, merge previous data with the new one and put  it in file.
4. If no any previous record then, simply create the file with the new data.
5. Return success message if user is created successfully

## Fetch Data
1. Fetch all the data that has been created.
2. Return data as json respone

## Delete Data
1. Here delete is based on email of the user.
2. Fetch all the record from the file.
3. Check if the record have the email that is to be deleted 
4. If email is present then create a new record after filtering the email
5. delete the file 
6. create new file from the filteed record
7. If email is not found throw error response



