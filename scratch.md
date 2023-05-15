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