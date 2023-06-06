#list-a-licous project

#Description of project
This project allow you to make a shopping list.<br>
You can find new recipes and if you can create and add new recipes.<br>
If you want to try new recipes, you can search for recipes by categories. If you don't have some ingredients that should be used in the recipe you decide to make, you can add the items from the recipes page to your shopping list.<br><br>

#setup
1-You need a database. <br>
We used local database.<br>
2-create  database that name is 'account'<br>
3-use sql queries for adding tables.<br>
	CREATE TABLE account (<br>
  email varchar(50) NOT NULL,<br>
  password varchar(8) NOT NULL,<br>
  username varchar(50) NOT NULL,<br>
  id int(11) NOT NULL<br>
	)<br>

| email | password    | username     |id  |
|-------|-------------|--------------|----|
|       |             |              |    |
|       |             |              |    |
<br>

	CREATE TABLE myList (<br>
  items varchar(255) DEFAULT NULL,<br>
  account_id int(11) DEFAULT NULL<br>
	)<br>
<br>
| items | account_id |
|-------|------------|
|       |            |<br>

	CREATE TABLE recepies (<br>
  title varchar(100) DEFAULT NULL,<br>
  ingredientsList text,<br>
  text mediumtext,<br>
  category varchar(30) DEFAULT NULL<br>
	)<br>

| title | ingredientList| text |
|-------|---------------|------|
|       |               |      |
|       |               |      |

<br>
4-Download the necessary code files from github and add them to the htdocs folder to execute on your localhost.<br>
5-You can now access the working project with the link "http://localhost:8888/...your folder path.../mainPage.html"<br>

#usage
First of all, to create your personal account, type the information required for the sign up section and press the "sign up" button.<br>
Now you can start using it by entering your information correctly.<br>
	Make shopping list<br>
	Search different recepies<br>
	Add new recepies<br>
	Add ingredient from recepies to shopping list<br>
	Delete ingredients<br>
	Change password<br>
	Delete your account<br>
	And log out<br>

#contrubition<br>
On the internet, we find lots of make shopping list and food recipe pages.<br>
What we added was to combine the shopping list with the recipe titles<br><br>

#projects' team members <br>
@esmanurarslan<br>
@EslemKurt<br>







