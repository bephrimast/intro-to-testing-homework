# intro-to-testing-homework
Homework for group 1 (2017-11-25)

## Individual assignments

Each assignment should be done as a separate Pull Request and it will be reviewed by others. These

Deadline is Monday, December 4th at 23:59. 

### Assignment 1: Implement calculateWithPercentage() using floats not integers

On the workshop we implemented this for integers, now lets do it for floats/doubles with precision on 2nd decimal.

Scenario: Calculating sales tax 
Given in USA prices do not include sales tax
And sales tax is 8%
When a person is buying a product for $100.00
They have to pay $108.00

Scenario: Rounding up sales tax
Given in USA prices do not include sales tax
And sales tax is 8%
And cent is the smallest measure
When a person is buying a product for $100.01
They have to pay $108.02 since we need to round up the number to next cent

### Assignment 2: Frog jump: Count minimal number of jumps from position X to Y.

This one is from codility https://codility.com/programmers/lessons/3-time_complexity/frog_jmp/

### Assignment 3: Brackets: Determine whether a given string of parentheses (multiple types) is properly nested.

Another one from codility: https://codility.com/programmers/lessons/7-stacks_and_queues/brackets/


## Team assignment: Currency exchange

Deadline is Wednesday, December 6th at 23:59. 

Build the core of the application that can calculate if customer bought euros 7 days ago, would they be earning money or not.

For the API, you can use http://hnbex.eu/api/v1/

Scenario: Earning
Given median EUR exchange rate was 7.5 seven days ago
And median EUR exchange rate is 7.6 today
When I would have bought them then and sold today 
Then I would earn 0.1 per each EUR I bought


Scenario: No changes
Given median EUR exchange rate was 7.4 seven days ago
And median EUR exchange rate is 7.4 today
When I would have bought them then and sold today 
Then I would have not earned or lost anything

Scenario: Loosing money
Given median EUR exchange rate was 7.6 seven days ago
And median EUR exchange rate is 7.4 today
When I would have bought them then and sold today 
Then I would loose 0.2 per each EUR I bought

Notices:
1) Talk to your team mate about structure of the code
2) Split tasks evenly (I know exact 50% split is not possible but it's more important to work together then to do the assignement!)
3) You should work on the same branch (not master)
4) I expect 100% test coverage
5) I suggest mocking as much as possible
6) Do create live test that will connect to API and return the live data
7) Create a pull request so the other team/group can review it (dont forget, if the other group reviews they dont know the assignment!)


