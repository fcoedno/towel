# Infrastructure Layer

This is the layer responsible to connect our core domain
to the outside world. By applying the [Hexagonal Architecture](http://alistair.cockburn.us/Hexagonal+architecture)
this layer would contain mostly Adapters for the interfaces defined
in the [Domain Layer](../Domain/README.md). 

As explained by [Matthias Noback]() this layer contains code for:

 - Handling HTTP Requests
 - Sending Emails
 - Accessing the database
 - Sending notifications
 - Generating random numbers
 - Reading current time
 
On this layer the code should be structured according to the
Specified Port and Adapter, for example:

```
Infra/
    Framework/ --> Framework specific files
    API/
        Rest/
        Soap/
    UserInterface/
        Web/
        Console/
    Persistence/
        Doctrine/
        InMemory/
    <Port>/
        <Adapter>/
        <Adapter>/
```