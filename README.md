<a id="readme-top"></a>

<!--
*** Thanks for checking out the Best-README-Template. If you have a suggestion
*** that would make this better, please fork the repo and create a pull request
*** or simply open an issue with the tag "enhancement".
*** Don't forget to give the project a star!
*** Thanks again! Now go create something AMAZING! :D
-->

<!-- PROJECT SHIELDS -->
<!--
*** I'm using markdown "reference style" links for readability.
*** Reference links are enclosed in brackets [ ] instead of parentheses ( ).
*** See the bottom of this document for the declaration of the reference variables
*** for contributors-url, forks-url, etc. This is an optional, concise syntax you may use.
*** https://www.markdownguide.org/basic-syntax/#reference-style-links
-->

[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]
[![MIT License][license-shield]][license-url]
[![LinkedIn][linkedin-shield]][linkedin-url]

<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="https://github.com/issam-mhj/gamestore">
    <img src="https://github.com/user-attachments/assets/0ae1b6d5-1a62-4b41-b2c7-c595a0460497" alt="Logo" width="80" height="80">
  </a>

<h3 align="center">GameStore</h3>

  <p align="center">
    GameXpress Admin API is a RESTful API developed with Laravel 11 and PHP 8.3. It provides a secure backend for managing products, categories, users, and orders in an e-commerce platform. This project follows best practices in authentication, role management, and API structuring.
    <br />
    <a href="https://github.com/issam-mhj/gamestore"><strong>Explore the docs »</strong></a>
    <br />
    <br />
    <a href="https://github.com/issam-mhj/gamestore">View Demo</a>
    &middot;
    <a href="https://github.com/issam-mhj/gamestore/issues/new?labels=bug&template=bug-report---.md">Report Bug</a>
    &middot;
    <a href="https://github.com/issam-mhj/gamestore/issues/new?labels=enhancement&template=feature-request---.md">Request Feature</a>
  </p>
</div>

<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#acknowledgments">Acknowledgments</a></li>
  </ol>
</details>

<!-- ABOUT THE PROJECT -->

## About The Project

[![Product Name Screen Shot][product-screenshot]](https://github.com/user-attachments/assets/721b7fb3-e480-4809-9023-fd48b82b1f8c)

This project is a RESTful API built with Laravel 11 and PHP 8.3, designed to serve as a backend for an e-commerce platform, specifically a game store. It incorporates features for managing products, categories, users, and authentication. The API employs Sanctum for authentication, role-based access control using Spatie's Laravel Permission package, and follows RESTful principles for API design.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

### Built With

*   [Laravel 11](https://laravel.com/)
*   [PHP 8.3](https://www.php.net/)
*   [Sanctum](https://laravel.com/docs/11.x/sanctum)
*   [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission/v6/introduction)

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- GETTING STARTED -->

## Getting Started

To get a local copy up and running, follow these steps.

### Prerequisites

*   PHP >= 8.2
*   Composer
*   Node.js and npm (if you plan to modify frontend assets)
*   A database (SQLite, MySQL, PostgreSQL, etc.)

### Installation

1.  Clone the repository:

    ```sh
    git clone https://github.com/issam-mhj/gamestore.git
    cd issam-mhj-gamestore
    ```

2.  Install PHP dependencies using Composer:

    ```sh
    composer install
    ```

3.  Copy the `.env.example` file to `.env` and configure your database connection:

    ```sh
    cp .env.example .env
    ```

    Edit the `.env` file to set your database credentials:

    ```
    DB_CONNECTION=sqlite
    DB_DATABASE=./database/database.sqlite
    ```

4.  Generate an application key:

    ```sh
    php artisan key:generate
    ```

5.  Run database migrations:

    ```sh
    php artisan migrate
    ```

6.  Seed the database with initial data (admin user, roles, and permissions):

    ```sh
    php artisan db:seed
    ```

7.  (Optional) If you intend to modify the frontend assets, install Node.js dependencies:

    ```sh
    npm install
    ```

8.  (Optional) Compile the assets:

    ```sh
    npm run build
    ```

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- USAGE EXAMPLES -->

## Usage

The API endpoints are protected using Laravel Sanctum. To access them, you'll need to register a user and obtain an API token.

1.  **Register a user:**

    ```
    POST /api/register
    ```

    with the following JSON payload:

    ```json
    {
        "name": "Your Name",
        "email": "your_email@example.com",
        "password": "your_password"
    }
    ```

2.  **Login to obtain an API token:**

    ```
    POST /api/login
    ```

    with the following JSON payload:

    ```json
    {
        "email": "your_email@example.com",
        "password": "your_password"
    }
    ```

    The response will contain a `token` field. Include this token in the `Authorization` header of your requests as a Bearer token:

    ```
    Authorization: Bearer your_token
    ```

3.  **Accessing protected endpoints:**

    For example, to list products:

    ```
    GET /api/products
    ```

    with the `Authorization` header set as described above.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- ROADMAP -->

## Roadmap

*   Implement order management features.
*   Add comprehensive unit and feature tests.
*   Implement API rate limiting.
*   Improve API documentation with Swagger or similar tools.
*   Implement user password reset functionality.

See the [open issues](https://github.com/issam-mhj/gamestore/issues) for a full list of proposed features (and known issues).

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- CONTRIBUTING -->

## Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue with the tag "enhancement".
Don't forget to give the project a star! Thanks again!

1.  Fork the Project
2.  Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3.  Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4.  Push to the Branch (`git push origin feature/AmazingFeature`)
5.  Open a Pull Request

<p align="right">(<a href="#readme-top">back to top</a>)</p>

### Top contributors:

<a href="https://github.com/issam-mhj/gamestore/graphs/contributors">
  <img src="https://contrib.rocks/image?repo=issam-mhj/gamestore" alt="contrib.rocks image" />
</a>

<!-- LICENSE -->

## License

Distributed under the MIT License. See `LICENSE.txt` for more information.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- CONTACT -->

## Contact

Your Name - [Issam Mhajri](https://www.linkedin.com/in/linkedin_username) - issammahtaj02@example.com

Project Link: [https://github.com/issam-mhj/gamestore](https://github.com/issam-mhj/gamestore)

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- ACKNOWLEDGMENTS -->

## Acknowledgments

*   [Laravel](https://laravel.com/)
*   [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission/v6/introduction)
*   [Sanctum](https://laravel.com/docs/11.x/sanctum)
*   [Best-README-Template](https://github.com/othneildrew/Best-README-Template)

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->

[contributors-shield]: https://img.shields.io/github/contributors/issam-mhj/gamestore.svg?style=for-the-badge
[contributors-url]: https://github.com/issam-mhj/gamestore/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/issam-mhj/gamestore.svg?style=for-the-badge
[forks-url]: https://github.com/issam-mhj/gamestore/network/members
[stars-shield]: https://img.shields.io/github/stars/issam-mhj/gamestore.svg?style=for-the-badge
[stars-url]: https://github.com/issam-mhj/gamestore/stargazers
[issues-shield]: https://img.shields.io/github/issues/issam-mhj/gamestore.svg?style=for-the-badge
[issues-url]: https://github.com/issam-mhj/gamestore/issues
[license-shield]: https://img.shields.io/github/license/issam-mhj/gamestore.svg?style=for-the-badge
[license-url]: https://github.com/issam-mhj/gamestore/blob/master/LICENSE.txt
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=555
[linkedin-url]: https://linkedin.com/in/linkedin_username
[product-screenshot]: https://github.com/user-attachments/assets/721b7fb3-e480-4809-9023-fd48b82b1f8c
[Next.js]: https://img.shields.io/badge/next.js-000000?style=for-the-badge&logo=nextdotjs&logoColor=white
[Next-url]: https://nextjs.org/
[React.js]: https://img.shields.io/badge/React-20232A?style=for-the-badge&logo=react&logoColor=61DAFB
[React-url]: https://reactjs.org/
[Vue.js]: https://img.shields.io/badge/Vue.js-35495E?style=for-the-badge&logo=vuedotjs&logoColor=4FC08D
[Vue-url]: https://vuejs.org/
[Angular.io]: https://img.shields.io/badge/Angular-DD0031?style=for-the-badge&logo=angular&logoColor=white
[Angular-url]: https://angular.io/
[Svelte.dev]: https://img.shields.io/badge/Svelte-4A4A55?style=for-the-badge&logo=svelte&logoColor=FF3E00
[Svelte-url]: https://svelte.dev/
[Laravel.com]: https://img.shields
