
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
