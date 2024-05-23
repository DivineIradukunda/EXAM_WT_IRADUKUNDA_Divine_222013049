Email:divine@gmail.com
Password:222013049

Documentation of Language Translation Tool Database
The Language Translation Tool database is designed to manage and store data related to users, translations, languages, source texts, translation history, feedback, dictionary entries, translation memories, glossary terms, and user preferences. Each table has a specific role and relationships with other tables to ensure the integrity and coherence of the data.
Tables and Their Roles
1.	User
•	Purpose: Stores information about the users of the language translation tool.
•	Fields:
•	User_id: Unique identifier for each user.
•	Username: Username of the user.
•	Email: Email address of the user.
•	Password: Password for the user account.
•	Role: Role of the user (e.g., admin, translator, user).
•	RegistrationDate: Date when the user registered.
•	Lastlogin: The last login date and time.
2.	Translation
•	Purpose: Stores information about translations performed by users.
•	Fields:
•	Translation_id: Unique identifier for each translation.
•	Translation_date: Date the translation was performed.
•	Translatedtext: The translated text.
•	SourceText_id: Foreign key referencing the SourceText table.
•	Language_id: Foreign key referencing the Language table.
3.	Language
•	Purpose: Stores information about the languages supported by the tool.
•	Fields:
•	Language_id: Unique identifier for each language.
•	Language_name: Name of the language.
•	ISO Code: ISO code for the language.
•	Native name: Native name of the language.
•	Country: Country where the language is primarily spoken.
•	Description: Description of the language.
4.	Source Text
•	Purpose: Stores the original texts that are to be translated.
•	Fields:
•	SourceText_id: Unique identifier for each source text.
•	Text: The original text.
•	Author: Author of the source text.
•	Creation_date: Date the source text was created.
•	LastModifiedDate: Date the source text was last modified.
•	Category: Category of the source text.
•	Status: Status of the source text.
5.	Translation History
•	Purpose: Stores the history of actions performed on translations.
•	Fields:
•	History_id: Unique identifier for each history record.
•	Action: Action taken (e.g., created, edited, deleted).
•	Action_date: Date and time the action was taken.
•	Comments: Comments regarding the action.
•	Translation_id: Foreign key referencing the Translation table.
6.	Feedback
•	Purpose: Stores feedback provided by users on translations.
•	Fields:
•	Feedback_id: Unique identifier for each feedback entry.
•	Rating: Rating given by the user.
•	Comment: Comment provided by the user.
•	Feedback_date: Date and time the feedback was given.
•	User_id: Foreign key referencing the User table.
•	Translation_id: Foreign key referencing the Translation table.
7.	Dictionary
•	Purpose: Stores dictionary entries with definitions and examples.
•	Fields:
•	Word_id: Unique identifier for each dictionary entry.
•	Word: The word or phrase.
•	Definition: Definition of the word.
•	ExampleSetence: Example sentence using the word.
•	Language_id: Foreign key referencing the Language table.
8.	Translation Memory
•	Purpose: Stores translation memory entries to facilitate future translations.
•	Fields:
•	Memory_id: Unique identifier for each memory entry.
•	TargetText: The translated text.
•	LastUsed: Date the memory entry was last used.
•	SourceText_id: Foreign key referencing the SourceText table.
•	Language_id: Foreign key referencing the Language table.
9.	Glossary
•	Purpose: Stores glossary terms and their definitions.
•	Fields:
•	Term_id: Unique identifier for each glossary term.
•	Term: The term or phrase.
•	Definition: Definition of the term.
•	CreatedDate: Date the term was added.
•	Language_id: Foreign key referencing the Language table.
10.	User Preference
•	Purpose: Stores user preferences for the interface and notifications.
•	Fields:
•	Preference_id: Unique identifier for each preference entry.
•	Theme: Theme preference (e.g., light, dark).
•	FontSize: Font size preference.
•	NotificationSetting: Notification setting preference.
•	User_id: Foreign key referencing the User table.
•	Language_id: Foreign key referencing the Language table.
