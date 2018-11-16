# Domain Layer

This layer contains the classes that represent the main business logic:

 - Entities
 - Value Objects
 - Domain events
 - Domain services
 - Repositories
 - Factories

All the code presented on this layer is totally independent from the outside world. If
any class needs external access it should be done by means of an interface and follow
the [Dependency Rule](http://blog.cleancoder.com/uncle-bob/2012/08/13/the-clean-architecture.html).