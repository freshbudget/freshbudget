https://flareapp.io/blog/20-collecting-metrics-for-flare-using-event-sourcing-and-laravel-stats
https://www.auxnet.de/en/blog/make-your-text-collection-searchable-with-python-and-meilisearch/

# Todo

- add the ability to allow a invitation to a user who will never have an actual accout, i.e spouse or child

# Income Overview

- Lifetime earnings
- Estimated earnings for the year
- 

# Income Notes

- The things I care about for an income
    - name
    - maybe a desc
    - file attachments, think pay stubs, etc
    - url to the portal to check income status
    - username to the portal
    - start date, think when did i start this income
    - end date, think if it is a past job and no longer providing income
    - active, a boolean, should this income count towards my total income
    - who's income it is, think me or my spouse
    - type of income, generally a salary or hourly
    - frequency of payment, like how many times a month generally
    - total estimated entitlement, think total pay before taxes / deductions
        - sub break down of each entitlement 
    - total estimated deductions, think taxes taken from pay before it hits my account
    - total estimated allotments, think anything I take directly from my paycheck before it hits my account
    - versioned estimated entitlement, deductions, allotments
    - actual  entitlement, deductions, allotments
    
    - because of the items above, i need to store the entitlement, deductions, allotments, etc. outside of the income model
    - they need to be configurable / searchable / chartable
    - possibly event sourced to support the input of past data that will stick allow for the same context to be built

- an income has many entitlements, the sum of which is the est entitlements amount
- an income has many taxes, the sum of which the est taxes amount
- an imcome has many deductions, the sum which is the est deducted amount
- an incomes estimated net amount is the following  (est entitlements) - (est taxes) - (est deductions)
- each of an incomes entitlements can be changed over time, thus need to be versioned??? event sourced??? active flag???

- When a user creates a one time budget, don't show it in the incomes list. Also show a form to say where the income went, i.e. to which account. My thought is maybe like a cash birthday present from grandma, I don't need care about tracking that income, but I need somewhere to log the income.

- What to call someone added to the budget but is just for tracking purposes, for example a childs name. Other roles: Member, Admin, Observer (tax planner, etc. basically read-only, persona), 