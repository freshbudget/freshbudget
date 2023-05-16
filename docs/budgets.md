# Budgets Documentation

This is a living document related to the `Budget` model.

## Things a `Budget` knows about itself

- It's name
- It's owner
- It's members
- It's currency
- If it is a users `personal` budget, i.e. the default budget created for the user when it was created

## Things a `Budget` model should have the ability to do

- Add a user to the members
- Check if a user is a member of the budget
- Check if it has a user with a given email
- Check if it is owned by a given user
- Remove a user from the members
- Check if any users currently have it as their current budget

## Things a `Budget` model should **not** have the ability to do

- Invite a user to join the budget

