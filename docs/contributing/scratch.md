## Links

- https://www.reddit.com/r/selfhosted/comments/11ja1k3/recommendations_for_easy_financial_management/
- https://flareapp.io/blog/20-collecting-metrics-for-flare-using-event-sourcing-and-laravel-stats
= https://www.auxnet.de/en/blog/make-your-text-collection-searchable-with-python-and-meilisearch/

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

# Lifecycle of an Income

- Show the income create form
- via the current budget -> incomes relationship, save the income
- If the user id is set, set the user id
- If it the income is a one-time frequency, set it to inactive
- Redirect to income show overview page

- account settings
    - add a theme selector (readonly)
    - add a sidebar preference 
    - add a default currency when creating new budgets
    - add description text to the inputs (below)
    - remove required on nickname

# Budget Integrations

- Inbound emails / parsing / attachments
- Zapier
- API tokens


- An income can be modeled as a "Revenue" account
- A transaction need to be drawn from an "account" and be deposited to another "account"

- An income entry would be logged as

- Date #
-- From | To | Amount
-- Income Name "Salary" | Asset Account "Wells Fargo Checking" | $3000.00

This mean that the salary account would experience a $3000.00 credit, and the Wells Fargo account would experience a $3000.00 debit

- Assets = Liabilities + Equity
- (WF Checking) = (Salary) + (0)
- +$3000 = (-$3000)

Types of Accounts:
- Assets (cash, accounts receivable and equipment | increased via debits)
- Liabilities (accounts payable, loans and accrued expenses | increased via credits)
- Equity (paid-in equity (funds from investors), retained earnings and common stock | increased via debits)
- Revenue (product sales, service fees and interest income | increased via credits)
- Expenses (inventory purchases, salaries and depreciation | increased via debits)

- Assets
- Liabilities
- Equity 
- Revenue
- Expenses 

Class Income extends Account
{
    public booted()
    {
        static::creating(function($income) {
            $income->type = AccountTypes::revenue,
        });
    }
}   
