# Exceptions Tree

- [BaseException](#baseexception)
  - [BusinessError](#businesserror)
  - [ClientError](#clienterror)
    - [BadRequest](#badrequest)
      - [SecurityBadRequest](#securitybadrequest)
      - [ValidationError \*](#validationerror-)
    - [Conflict](#conflict)
    - [Forbidden](#forbidden)
      - [SecurityForbidden](#securityforbidden)
    - [NotFound](#notfound)
    - [Unauthorized](#unauthorized)
  - [ServerError](#servererror)
    - [FatalError](#fatalerror)
    - [NotImplemented](#notimplemented)
    - [ProgramError](#programerror)
    - [ServiceError](#serviceerror)
    - [UncaughtException](#uncaughtexception)


## BaseException
The base exception class for all other custom exceptions.

### BusinessError
Throw a `BusinessError` when a normal logical error occurred and you want to terminate the following procedure. This type of error is not harmful and may not require logging.

For example, if a user tries to complete a payment with insufficient funds, you can throw a `BusinessError` to remind them to deposit more money into their account balance.

### ClientError
An error caused by a bad client request.

#### BadRequest
A bad request send by a client

##### SecurityBadRequest
This class extends the `BadRequest` exception but changes the default status code to 200 to make the client think that their request has been accepted.

This is done to prevent malicious users from adjusting their script and improving the attack, since they might realise their request has been blocked and figure out another way to bypass it.

##### ValidationError *
#### Conflict
#### Forbidden
##### SecurityForbidden
#### NotFound
#### Unauthorized
An unauthorized request.

### ServerError
#### FatalError
Represents a PHP fatal error as an exception that can be handled like other exceptions.

It encapsulates an error retrieved using `last_get_error`, often being used in a `register_shutdown_function` to handle fatal error.

#### NotImplemented
#### ProgramError
#### ServiceError
#### UncaughtException