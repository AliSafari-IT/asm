/*
 Schema::create('users', function (Blueprint $table) {
 $table->id();
 $table->string('name');
 $table->string('email')->unique();
 $table->timestamp('email_verified_at')->nullable();
 $table->string('password');
 $table->rememberToken();
 $table->timestamps();
 });
 */
-- database\insert_values.sql: Bcrypt algorithm is used to hash passwords.
INSERT INTO users
VALUES (
        NULL,
        'Ali',
        'asafarim+ali@gmail.com',
        '2022-12-05 09:30:00',
        '$2y$10$.HhQ0uz2kW2PeVPqCPxXAO4gy9I/QumCHGenWe3x8zD63vpfcCxP2',
        NULL,
        '2022-12-05 09:30:00',
        NULL
    ),
    (
        NULL,
        'Kian',
        'asafarim+kian@gmail.com',
        '2022-12-05 09:30:00',
        '$2y$10$ay8fdfcr5ekhzhRiTNmXbuXTuQtqtWNm8uano7/qGtY8pEN1QL7H2',
        NULL,
        '2022-12-05 09:30:00',
        NULL
    ),
    (
        NULL,
        'Tara',
        'asafarim+tara@gmail.com',
        '2022-12-05 09:30:00',
        '$2y$10$V73.9YAP91gMR47B4hrmS.lbUzHSf6zLQ3QY4sySnzLGBtGhL4Q7e',
        NULL,
        '2022-12-05 09:30:00',
        NULL
    ),
    (
        NULL,
        'Anja',
        'asafarim+anja@gmail.com',
        '2022-12-05 09:30:00',
        '$2y$10$XwahSHw3OoxXjitOrg526OAlsJ5jcAzWk4y4xoU8UL10C9ysVFKm.',
        NULL,
        '2022-12-05 09:30:00',
        NULL
    );
/* 
 Schema::create('roles', function (Blueprint $table) {
 $table->id();
 $table->string('name');
 $table->string('description')->nullable();
 $table->softDeletes();
 $table->string('slug')->unique()->nullable();            
 $table->timestamps();
 });
 */
INSERT INTO roles (id, name, description, slug)
VALUES (NULL, 'admin', 'Administrator', '/admin'),
    (NULL, 'author', 'Author', '/author'),
    (NULL, 'user', 'User', '/user'),
    (NULL, 'guest', 'Guest', '/guest');
/*
 Schema::create('permissions', function (Blueprint $table) {
 $table->id();
 $table->string('name');
 $table->string('description')->nullable();
 $table->string('slug')->unique()->nullable();
 $table->timestamps();
 });
 */
INSERT INTO permissions (id, name, description, slug)
VALUES (
        NULL,
        'editPosts',
        'Users can Edit Posts',
        '/editPosts'
    ),
    (
        NULL,
        'deletePosts',
        'Users can Delete Posts',
        '/deletePosts'
    ),
    (
        NULL,
        'createPosts',
        'Users can Create Posts',
        '/createPosts'
    ),
    (
        NULL,
        'editUsers',
        'Users can Edit Users',
        '/editUsers'
    ),
    (
        NULL,
        'deleteUsers',
        'Users can Delete Users',
        '/deleteUsers'
    ),
    (
        NULL,
        'createUsers',
        'Users can Create Users',
        '/createUsers'
    ),
    (
        NULL,
        'editRoles',
        'Users can Edit Roles',
        '/editRoles'
    ),
    (
        NULL,
        'deleteRoles',
        'Users can Delete Roles',
        '/deleteRoles'
    ),
    (
        NULL,
        'createRoles',
        'Users can Create Roles',
        '/createRoles'
    ),
    (
        NULL,
        'editPermissions',
        'Users can Edit Permissions',
        '/editPermissions'
    ),
    (
        NULL,
        'deletePermissions',
        'Users can Delete Permissions',
        '/deletePermissions'
    ),
    (
        NULL,
        'createPermissions',
        'Users can Create Permissions',
        '/createPermissions'
    );
/*
 Schema::create('role_user', function (Blueprint $table) {
 $table->unsignedBigInteger('role_id');
 $table->unsignedBigInteger('user_id');
 $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
 $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
 $table->primary(['role_id', 'user_id']); // Composite primary key
 $table->timestamps();
 });
 */
INSERT INTO role_user (role_id, user_id)
VALUES (1, 1),
    (1, 2),
    (2, 3),
    (4, 1),
    (4, 2),
    (4, 3),
    (4, 4);
/*
 Schema::create('permission_role', function (Blueprint $table) {
 $table->unsignedBigInteger('permission_id');
 $table->unsignedBigInteger('role_id');
 $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
 $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
 $table->primary(['permission_id', 'role_id']); // Composite primary key
 $table->timestamps();
 });
 */
INSERT INTO permission_role (permission_id, role_id)
VALUES (1, 1),
    (2, 1),
    (3, 1),
    (4, 1),
    (1, 2),
    (2, 2),
    (1, 3),
    (2, 3),
    (1, 4);
/*
 Schema::create('settings', function (Blueprint $table) {
 $table->id();
 $table->string('key');
 $table->string('value');
 $table->timestamps();
 
 $table->index(['key', 'deleted_at']); 
 * Optimize for queries filtering by 'key' and optionally 'deleted_at'
 * Consider other indexes based on actual query patterns
 });
 */
INSERT INTO settings (id, key, value)
VALUES (NULL, 'site.title', 'My Site'),
    (NULL, 'site.description', 'My Site Description'),
    (NULL, 'site.keywords', 'My Site, Laravel, PHP'),
    (NULL, 'site.author', 'My Name'),
    (NULL, 'site.email', 'My Email'),
    (NULL, 'site.timezone', 'UTC'),
    (NULL, 'site.locale', 'en'),
    (NULL, 'site.currency', 'USD'),
    (NULL, 'theme.name', 'default'),
    (NULL, 'theme.custom_css', 'default_style.css'),
    (NULL, 'theme.custom_js', 'default_script.js'),
    (NULL, 'theme.custom_favicon', 'favicon.ico');
/*
 Schema::create('tags', function (Blueprint $table) {
 $table->id(); // Unique identifier for each tag
 $table->string('name', 191)->unique(); // The name of the tag, unique
 $table->string('slug', 191)->unique(); // A URL-friendly version of the tag name, unique
 $table->timestamps(); // Timestamps to track when tags are created or updated
 });
 */
INSERT INTO tags (name, slug)
VALUES ('AI', '/ai'),
    ('Laravel', '/laravel'),
    ('PHP', '/php'),
    ('Python', '/python'),
    ('C++', '/c++'),
    ('C#', '/c#'),
    ('Java', '/java'),
    ('Javascript', '/javascript'),
    ('Ruby', '/ruby'),
    ('Swift', '/swift'),
    ('Kotlin', '/kotlin'),
    ('Golang', '/golang'),
    ('C', '/c');
/**
 Schema::create('categories', function (Blueprint $table) {
 $table->id();
 $table->string('name');
 $table->string('slug')->unique()->nullable();
 $table->string('description')->nullable();
 $table->timestamps();
 });
 */
INSERT INTO categories (name, slug, description)
VALUES (
        'Augmented Reality',
        'augmented-reality',
        'Integrating digital information with the users environment in real time. Unlike virtual reality, which creates a totally artificial environment, augmented reality uses the existing environment and overlays new information on top of it.'
    ),
    (
        'DevOps',
        'devops',
        'A set of practices that combines software development (Dev) and IT operations (Ops) aimed at shortening the systems development life cycle and providing continuous delivery with high software quality.'
    ),
    (
        'Artificial Intelligence',
        'artificial-intelligence',
        'The simulation of human intelligence in machines that are programmed to think like humans and mimic their actions.'
    ),
    (
        'Mobile Development',
        'mobile-development',
        'The act of building interactive mobile apps for Android and iOS devices.'
    ),
    (
        'Game Development',
        'game-development',
        'The art and science of creating games, including the design, development, and release of a game.'
    ),
    (
        'API Design',
        'api-design',
        'The process of developing application programming interfaces (APIs) that expose data and application functionality for use by developers and users.'
    ),
    (
        'User Experience Design',
        'user-experience-design',
        'The process of creating products that provide meaningful and relevant experiences to users. This involves the design of the entire process of acquiring and integrating the product, including aspects of branding, design, usability, and function.'
    ),
    (
        'Big Data',
        'big-data',
        'Technologies and practices for collecting, storing, analyzing, and extracting useful information from complex and large data sets.'
    ),
    (
        'Open Source Projects',
        'open-source-projects',
        'Software projects that are open to the public and encourage community collaboration and contribution.'
    ),
    (
        'Performance Optimization',
        'performance-optimization',
        'The process of making software or applications run faster and more efficiently.'
    ),
    (
        'Web Development',
        'web-development',
        'Everything about developing websites and web applications.'
    ),
    (
        'Data Science',
        'data-science',
        'The science of analyzing complex data to find trends, patterns, and insights.'
    ),
    (
        'Cybersecurity',
        'cybersecurity',
        'Protecting computer systems and networks from information disclosure, theft of or damage to their hardware, software, or electronic data, as well as from the disruption or misdirection of the services they provide.'
    ),
    (
        'Cloud Computing',
        'cloud-computing',
        'Using a network of remote servers hosted on the Internet to store, manage, and process data, rather than a local server or a personal computer.'
    ),
    (
        'Machine Learning',
        'machine-learning',
        'An application of artificial intelligence (AI) that provides systems the ability to automatically learn and improve from experience without being explicitly programmed.'
    ),
    (
        'Software Engineering',
        'software-engineering',
        'The systematic application of engineering approaches to the development of software.'
    ),
    (
        'Networking',
        'networking',
        'Connecting computers and other devices to share resources and exchange data.'
    ),
    (
        'Blockchain',
        'blockchain',
        'A system of recording information in a way that makes it difficult or impossible to change, hack, or cheat the system.'
    ),
    (
        'Virtual Reality',
        'virtual-reality',
        'The use of computer technology to create a simulated environment.'
    ),
    (
        'Internet of Things',
        'internet-of-things',
        'Interconnecting computing devices embedded in everyday objects, enabling them to send and receive data.'
    );
/*
 Schema::create('articles', function (Blueprint $table) {
 $table->id();
 $table->string('title');
 $table->string('slug')->unique(); // Ensure slugs are unique
 $table->json('images')->nullable(); // Store images as a JSON string
 $table->longText('body'); // Suitable for storing large HTML or rich text content
 $table->foreignId('user_id')->constrained()->onDelete('cascade');
 $table->foreignId('category_id')->constrained()->onDelete('cascade');
 $table->enum('docType', ['news', 'article', 'event', 'project', 'tutorial','report', 'technical_report', 'paper', 'conference_paper', 'book', 'technical_book','research_paper' , 'other'])->default('news');
 $table->timestamp('published_at')->nullable();
 $table->boolean('is_published')->default(false);
 $table->boolean('is_public')->default(false);
 $table->timestamps();
 });
 */
INSERT INTO articles (
        title,
        slug,
        images,
        body,
        user_id,
        category_id,
        docType,
        is_published,
        is_public,
        published_at
    )
VALUES (
        'Introduction to HTML',
        'introduction-to-html',
        '["/images/html-intro.jpg"]',
        '<p>HTML stands for HyperText Markup Language. It is the standard markup language for documents designed to be displayed in a web browser.</p>',
        1,
        1,
        'tutorial',
        true,
        true,
        '2024-03-23 10:00:00'
    ),
    (
        'CSS Basics for Beginners',
        'css-basics-for-beginners',
        '["/images/css-basics.jpg"]',
        '<p>Cascading Style Sheets (CSS) is a style sheet language used for describing the presentation of a document written in HTML.</p>',
        1,
        2,
        'tutorial',
        true,
        true,
        '2024-03-24 10:00:00'
    ),
    (
        'JavaScript Fundamentals',
        'javascript-fundamentals',
        '["/images/js-fundamentals.jpg"]',
        '<p>JavaScript is a programming language that enables interactive web pages. It is a part of most web browsers.</p>',
        1,
        3,
        'tutorial',
        true,
        true,
        '2024-03-25 10:00:00'
    ),
    (
        'Understanding Web Security',
        'understanding-web-security',
        '["/images/web-security.jpg"]',
        '<p>Web security is important to prevent hacking and unauthorized data access.</p>',
        2,
        4,
        'article',
        true,
        true,
        '2024-03-26 10:00:00'
    ),
    (
        'Introduction to Cloud Computing',
        'introduction-to-cloud-computing',
        '["/images/cloud-computing.jpg"]',
        '<p>Cloud computing is the delivery of different services through the Internet, including data storage, servers, databases, networking, and software.</p>',
        2,
        5,
        'tutorial',
        true,
        true,
        '2024-03-27 10:00:00'
    ),
    (
        'Building RESTful APIs',
        'building-restful-apis',
        '["/images/restful-apis.jpg"]',
        '<p>RESTful API is an application programming interface (API) that uses HTTP requests to GET, PUT, POST and DELETE data.</p>',
        3,
        6,
        'tutorial',
        true,
        true,
        '2024-03-28 10:00:00'
    ),
    (
        'Introduction to Machine Learning',
        'introduction-to-machine-learning',
        '["/images/machine-learning.jpg"]',
        '<p>Machine learning is a type of artificial intelligence (AI) that allows software applications to become more accurate at predicting outcomes without being explicitly programmed to do so.</p>',
        3,
        7,
        'article',
        true,
        true,
        '2024-03-29 10:00:00'
    ),
    (
        'The Basics of Git and GitHub',
        'the-basics-of-git-and-github',
        '["/images/git-github.jpg"]',
        '<p>Git is a distributed version-control system for tracking changes in source code during software development.</p>',
        4,
        8,
        'tutorial',
        true,
        true,
        '2024-03-30 10:00:00'
    ),
    (
        'Responsive Web Design',
        'responsive-web-design',
        '["/images/responsive-design.jpg"]',
        '<p>Responsive web design is an approach to web design that makes web pages render well on a variety of devices and window or screen sizes.</p>',
        4,
        9,
        'tutorial',
        true,
        true,
        '2024-03-31 10:00:00'
    ),
    (
        'Advanced CSS Techniques',
        'advanced-css-techniques',
        '["/images/advanced-css.jpg"]',
        '<p>Explore advanced CSS techniques to take your web design to the next level.</p>',
        5,
        10,
        'article',
        true,
        true,
        '2024-04-01 10:00:00'
    );
INSERT INTO articles_tags (article_id, tag_id)
VALUES (1, '8'),
    -- Assuming 'Javascript Fundamentals' article is related to 'Javascript'
    (2, '3'),
    -- 'CSS Basics for Beginners' could be associated with 'PHP' due to web development context
    (3, '8'),
    -- 'JavaScript Fundamentals' obviously goes with 'Javascript'
    (4, '1'),
    -- 'Understanding Web Security' might relate to 'AI' for AI-driven security solutions
    (5, '2'),
    -- 'Introduction to Cloud Computing' associated with 'Laravel' because of Laravel's cloud deployment capabilities
    (6, '7');
-- 'Building RESTful APIs' could relate to 'Java' given its use in backend development