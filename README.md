#list-a-licous project

#Description of project
This project allow you to make a shopping list.
You can find new recipes and if you can create and add new recipes.
If you want to try new recipes, you can search for recipes by categories. If you don't have some ingredients that should be used in the recipe you decide to make, you can add the items from the recipes page to your shopping list.

#setup
1-You need a database. 
We used local database.
2-create  database that name is 'account'
3-use sql queries for adding tables.
	CREATE TABLE account (
  email varchar(50) NOT NULL,
  password varchar(8) NOT NULL,
  username varchar(50) NOT NULL,
  id int(11) NOT NULL
	)

| email | password    | username     |id  |
|-------|-------------|--------------|----|
|       |             |              |    |
|       |             |              |    |


	CREATE TABLE myList (
  items varchar(255) DEFAULT NULL,
  account_id int(11) DEFAULT NULL
	)

| items | account_id |
|-------|------------|
|       |            |

	CREATE TABLE recepies (
  title varchar(100) DEFAULT NULL,
  ingredientsList text,
  text mediumtext,
  category varchar(30) DEFAULT NULL
	)

| title | ingredientList| text |
|-------|---------------|------|
|       |               |      |
|       |               |      |


4-Download the necessary code files from github and add them to the htdocs folder to execute on your localhost.
5-You can now access the working project with the link "http://localhost:8888/...your folder path.../mainPage.html"

#usage
First of all, to create your personal account, type the information required for the sign up section and press the "sign up" button.
Now you can start using it by entering your information correctly.
	Make shopping list
	Search different recepies
	Add new recepies
	Add ingredient from recepies to shopping list
	Delete ingredients
	Change password
	Delete your account
	And log out

#contrubition
On the internet, we find lots of make shopping list and food recipe pages.
What we added was to combine the shopping list with the recipe titles

#projects' team members 
@esmanurarslan
@EslemKurt







