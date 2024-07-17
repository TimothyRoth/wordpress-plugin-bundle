Shortcodes:
===========
This plugin provides a set of shortcodes for use in your WordPress site.

[show_faqs]
shortcode args
amount default = -1;
post_ids default = [], values comma separated numbers;
order default = 'ASC' values = 'ASC' or 'DESC';

[show_faqs] shortcode example: [show_faqs amount="3" post_ids="530, 529, 528" order="DESC"]

[show_team]
shortcode args
amount default = -1;
order default = 'ASC' values = 'ASC' or 'DESC';

[show_team] shortcode example: [show_team amount="3" order="DESC"]

[show_blogposts]
shortcode args
amount default = 3, amount of displayed posts;
post_ids default = [], values comma separated numbers;
order default = 'DESC' values = 'ASC' or 'DESC';
search_query default = '', values = string, displays posts that match the search query;
show_archive_button default = 'true', values = 'true' or 'false', displays the archive link if true;

[show_blogposts]
shortcode example: [show_blogposts amount="3" post_ids="530, 529, 528" order="ASC" show_archive="true"]

[show_blogposts_archive]
shortcode example: [show_blogposts_archive show_more="true" ]
amount default = 3, amount of initially displayed posts;
order default = 'ASC' values = 'ASC' or 'DESC';
excerpt_length default = 20, amount of words in the excerpt;
show_more_button default = 'true', values = 'true' or 'false', displays ajax load more button if true;
search_filter default =  'true', values = 'true' or 'false', displays search filter if true;
posts_to_add default = 3, amount of posts to add on each load more click;

Examples:
===========

FAQS
====

show all faqs
[show_faqs]

show 3 faqs with ids 530, 529, 528 in descending order
[show_faqs amount="3" post_ids="530, 529, 528" order="DESC"]

show 6 faqs without specific ids or order
[show_faqs amount="6"]

Team
====

show all team members
[show_team]

show 3 team members in descending order
[show_team amount="3" order="DESC"]

show 6 team members
[show_team amount="6"]

BLOGPOSTS
====

SINGLE
==
show all blogposts
[show_blogposts]

show 3 blogposts with ids 530, 529, 528 in descending order
[show_blogposts amount="3" post_ids="530, 529, 528" order="DESC"]

show 6 blogposts without specific ids or order but without archive link
[show_blogposts amount="6" show_archive="false"]

show 10 blogposts with search query "test" and no archive link
[show_blogposts amount="10" search_query="test" show_archive="false"]

ARCHIVE
==

display ALL blogposts without search filter and ajax load more button
[show_blogposts_archive amount="-1" search_filter="false" show_more="false"]

display 3 blogposts and add 3 more on each load more click
[show_blogposts_archive amount="3" posts_to_add="3"]

display 10 blogposts with ajax load more button and search filter
[show_blogposts_archive posts_to_add="10"]

display all blogposts with descending order and no specific ids
[show_blogposts_archive order="DESC" amount="-1"]

display 6 blogposts on the archive page with ajax load more button and no search filter
[show_blogposts_archive amount="6" search_filter="false"]


