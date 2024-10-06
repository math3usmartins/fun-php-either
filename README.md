# Functional PHP Either

This package provides a minimalist implementation of `Either<T>` to support
functions with pure error handling in `PHP`.

This package does **NOT** have any goals to become a popular package in the PHP
community, since `PHP` is not the best language for functional programming.

The only goal of this package is to support some small and legacy projects
in `PHP` where I want to problems using functional programming as it has great
benefits.

It follows the convention of most popular languages and libraries supporting
functional programming. e.g. `Either` is right-biased, meaning it stops the 
computing when the value is `Left`, but it continues for `Right` values.

## Reference

This package is heavily inspired on
[Professor Frisby's Mostly Adequate Guide to Functional Programming](https://mostly-adequate.gitbook.io/mostly-adequate-guide).
Specifically the section named "Pure Error Handling".

It is also inspired on the [fp-ts package for Typescript](https://github.com/gcanti/fp-ts)
