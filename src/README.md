# Application Structure

The application structure mostly follows what Matthias Noback
describes as [Advanced Application Structure](https://matthiasnoback.nl/2017/07/layers-ports-and-adapters-part-1-introduction/).
The goal here is defining a strict set of layers in order to achieve a better application
structure that is easier to maintain, framework-independent and testable.

This structure defines three types of layers:

 - [Infrastructure](./Infra/README.md) (or Infra for short)
 - [Application](./Application/README.md)
 - [Domain](./Domain/README.md)
 
## Dependency Rule

This rule states that a given layer should only depend on 
code defined in the same layer or in a deeper one. Of course, the
[Domain Layer](./Domain/README.md) will definitely need database access
(defined on the [Infra Layer](./Infra/README.md)). To allow for that, we
simply create an Interface on the [Domain Layer](./Domain/README.md) and
implement it on the correct layer. This way our precious Domain will
remain untouched by details and by using [Dependency Injection](https://en.wikipedia.org/wiki/Dependency_injection) tools 
we are able to achieve an extremely flexible architecture.
