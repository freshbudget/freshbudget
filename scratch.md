https://flareapp.io/blog/20-collecting-metrics-for-flare-using-event-sourcing-and-laravel-stats

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

- an income has many entitlements, the sum of which is the gross amount
- an income has many taxes, the sum of which the taxed amount
- an imcome has many deductions, the sum which is the deducted amount
- an incomes estimated amount is the following  (gross amount) - (taxed amount) - (deducted amount)
- each on an incomes entitlements can be changed over time, thus need to be versioned??? event sourced??? active flag???

Before firing off an event, an aggregate will first check if it is allowed to fire off that particular event. Using our example again, the aggregate will first loop through all previous events of that income and calculate the current estimated amount.

okay so i want to get the incomes estimated mountly amount, I will ask the model to retieve the estimated_amount, this estimated amount be written to the income model(?) for ease of retrival. However it is actually a projection of all the incomes history of entitlements, taxes, and deductions.

So when I want to update a income entitlement, I set the new amount(s) and "click save". this will `make` a new income entitlment record, which will be handled by the projector. The projector will take that unsaved record, and do the calculation to determine the incomes new estimated monthly income.

Why can't i just store the amount in laravel stats again? Maybe I will need to anyways, because I need to be able to plot estimated montly income over time anyways?

- How to handle incomes that are assigned to a user that are attached to a budget, if the user leaves the budget?

- When a user creates a one time budget, don't show it in the incomes list. Also show a form to say where the income went, i.e. to which account. My thought is maybe like a cash birthday present from grandma, I don't need care about tracking that income, but I need somewhere to log the income.