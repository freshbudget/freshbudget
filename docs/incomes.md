# Incomes

This is a living document related to the `Budget` model.

## Things an `Income` knows about itself

- It's name
- It's budget
- If it belongs to a user in the budget
- It's type (salary, hourly, sales, etc.)
- It's currency
- It's frequency (monthly, weekly, etc.)

## Things an `Income` model should have the ability to do

## Things a `Income` model should **not** have the ability to do

## As a user, i want to quickly know the following about an income

- name
- budget
- who it belongs to (me, spouse, joint, etc.)
- type 
- estimated monthly amount
- estimated yearly amount

## As a user, i want to track the following about an income

- estimated monthly / yearly amount over time
- the next estimated pay date
- the amount of taxes payed over time
- the lifetime earnings

- income-entry
    - date
    - gross amount
    - deducted amount
    - taxes amount
    - takehome amount


1 create an income shell
2 configure the entitlements
3 configure the taxes
4 configure the deductions
5 save and have an estimated net montly
6 log an income entry
7 accept the default entitlements, which will calculate the total
8 modify the default taxes, which will calculate the total and update the latest taxes model?
9 accept the default deductions which will calculate the total
10 save the entry
11 the model will do the calculate for actual net monthly