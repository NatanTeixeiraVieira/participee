describe('Login Page', () => {
  beforeEach(() => {
    cy.visit('/login');
  });

  it('should display all form fields', () => {
    cy.get('input[name="email"]').should('exist');
    cy.get('input[name="password"]').should('exist');
    cy.contains('button', 'Entrar').should('exist');
    cy.contains('a', 'Não tem uma conta? Cadastre-se').should('exist');
  });

  it('should show validation errors if form is submitted empty', () => {
    cy.contains('button', 'Entrar').click();

    cy.get('.invalid-feedback').should('contain', 'O campo email é obrigatório');
    cy.get('.invalid-feedback').should('contain', 'O campo senha é obrigatório');
  });

  it('should show error if credentials are invalid', () => {
    cy.get('input[name="email"]').type('invalid@example.com');
    cy.get('input[name="password"]').type('wrongpassword');

    cy.contains('button', 'Entrar').click();

    cy.get('.invalid-feedback')
      .should('exist')
      .and('contain', 'Email ou senha inválidos');
  });

  it('should login successfully with valid credentials', () => {
    cy.visit('/register');

    const currentTime = new Date().getTime()
    const email = `validuser@example${currentTime}.com`;
    const password = `password${currentTime}`;
    cy.get('input[name="name"]').type('Test User');
    cy.get('input[name="email"]').type(email);
    cy.get('input[name="password"]').type(password);
    cy.get('input[name="password_confirmation"]').type(password);
    cy.contains('button', 'Cadastrar').click();

    cy.visit('/login');

    cy.get('input[name="email"]').type(email);
    cy.get('input[name="password"]').type(password);

    cy.contains('button', 'Entrar').click();

    cy.url().should('not.include', '/login');
    cy.contains('Logout').should('exist');
  });

  it('should navigate to register page when clicking the register link', () => {
    cy.contains('Não tem uma conta? Cadastre-se').click();
    cy.url().should('include', '/register');
  });
});
