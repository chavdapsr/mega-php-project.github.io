# Contributing to Mega PHP Learning Project

Thank you for your interest in contributing to this PHP learning project! This document provides guidelines for contributors.

## How to Contribute

### Reporting Issues

- Use the GitHub issue tracker to report bugs
- Provide clear descriptions of the issue
- Include steps to reproduce the problem
- Mention your PHP version and environment

### Making Changes

1. **Fork the repository**
2. **Create a feature branch**: `git checkout -b feature/your-feature-name`
3. **Make your changes** following the coding standards
4. **Test your changes** thoroughly
5. **Commit your changes** with descriptive messages
6. **Push to your fork**: `git push origin feature/your-feature-name`
7. **Create a Pull Request**

### Coding Standards

- Follow PSR-12 coding standards
- Use meaningful variable and function names
- Add comments where necessary
- Keep functions small and focused
- Follow the existing MVC structure

### Adding New Features

When adding new features:

1. **Models**: Create in `app/Models/`
2. **Controllers**: Create in `app/Controllers/`
3. **Views**: Create in `views/`
4. **Routes**: Add to `public/index.php`
5. **Database**: Update schema if needed

### Testing

- Test all new functionality
- Ensure existing features still work
- Test with different PHP versions if possible
- Check for security vulnerabilities

## Project Structure

```
├── app/
│   ├── Core/           # Core classes
│   ├── Controllers/    # Application controllers
│   └── Models/         # Data models
├── config/             # Configuration files
├── database/           # Database schema
├── public/             # Public assets and entry point
├── views/              # View templates
└── README.md
```

## Guidelines

- Keep the educational focus of the project
- Write clean, readable code
- Document your changes
- Be respectful and constructive in discussions
- Follow the existing code style

## License

By contributing, you agree that your contributions will be licensed under the MIT License.

Thank you for contributing!
