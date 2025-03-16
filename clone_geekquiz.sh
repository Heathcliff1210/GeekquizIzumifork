#!/bin/bash

# Script to clone and set up Geekquiz repository
# Created for automated repository setup

set -e  # Exit immediately if a command exits with a non-zero status

# Terminal colors for better readability
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
RED='\033[0;31m'
NC='\033[0m' # No Color

echo -e "${BLUE}=== Geekquiz Repository Setup ===${NC}"
echo -e "${YELLOW}This script will clone the Geekquiz repository and help set it up for development.${NC}"
echo ""

# Check if git is installed
if ! command -v git &> /dev/null; then
    echo -e "${RED}Error: Git is not installed. Please install Git first.${NC}"
    exit 1
fi

# Set the repository URL and target directory
REPO_URL="https://github.com/arcanoecole-It1/Geekquiz.git"
TARGET_DIR="Geekquiz"

# Check if the target directory already exists
if [ -d "$TARGET_DIR" ]; then
    echo -e "${YELLOW}Warning: The directory '$TARGET_DIR' already exists.${NC}"
    read -p "Do you want to overwrite it? (y/n): " -n 1 -r
    echo
    if [[ ! $REPLY =~ ^[Yy]$ ]]; then
        echo -e "${YELLOW}Operation cancelled.${NC}"
        exit 0
    fi
    rm -rf "$TARGET_DIR"
fi

# Clone the repository
echo -e "${BLUE}Cloning the repository...${NC}"
git clone "$REPO_URL" "$TARGET_DIR"

if [ $? -ne 0 ]; then
    echo -e "${RED}Failed to clone the repository. Please check the URL and your internet connection.${NC}"
    exit 1
fi

echo -e "${GREEN}Repository cloned successfully to $TARGET_DIR${NC}"

# Change to the repository directory
cd "$TARGET_DIR"

# Check for package.json (Node.js project)
if [ -f "package.json" ]; then
    echo -e "${BLUE}Node.js project detected. Checking for npm...${NC}"
    
    if ! command -v npm &> /dev/null; then
        echo -e "${YELLOW}npm not found. Please install Node.js and npm to proceed with setup.${NC}"
    else
        echo -e "${BLUE}Installing dependencies with npm...${NC}"
        npm install
        if [ $? -ne 0 ]; then
            echo -e "${RED}Failed to install Node.js dependencies.${NC}"
        else
            echo -e "${GREEN}Node.js dependencies installed successfully.${NC}"
        fi
    fi
fi

# Check for requirements.txt (Python project)
if [ -f "requirements.txt" ]; then
    echo -e "${BLUE}Python project detected. Checking for pip...${NC}"
    
    if ! command -v pip &> /dev/null && ! command -v pip3 &> /dev/null; then
        echo -e "${YELLOW}pip not found. Please install Python and pip to proceed with setup.${NC}"
    else
        PIP_CMD="pip"
        if command -v pip3 &> /dev/null; then
            PIP_CMD="pip3"
        fi
        
        echo -e "${BLUE}Installing dependencies with $PIP_CMD...${NC}"
        $PIP_CMD install -r requirements.txt
        if [ $? -ne 0 ]; then
            echo -e "${RED}Failed to install Python dependencies.${NC}"
        else
            echo -e "${GREEN}Python dependencies installed successfully.${NC}"
        fi
    fi
fi

# Check for composer.json (PHP project)
if [ -f "composer.json" ]; then
    echo -e "${BLUE}PHP project detected. Checking for composer...${NC}"
    
    if ! command -v composer &> /dev/null; then
        echo -e "${YELLOW}Composer not found. Please install Composer to proceed with setup.${NC}"
    else
        echo -e "${BLUE}Installing dependencies with composer...${NC}"
        composer install
        if [ $? -ne 0 ]; then
            echo -e "${RED}Failed to install PHP dependencies.${NC}"
        else
            echo -e "${GREEN}PHP dependencies installed successfully.${NC}"
        fi
    fi
fi

# Look for any setup instructions in the repository
echo -e "${BLUE}Looking for setup instructions in the repository...${NC}"
if [ -f "README.md" ]; then
    echo -e "${GREEN}README.md file found. Please check it for specific setup instructions.${NC}"
    echo -e "${YELLOW}You can view it with: less README.md${NC}"
fi

if [ -f "INSTALL.md" ]; then
    echo -e "${GREEN}INSTALL.md file found. Please check it for specific installation instructions.${NC}"
    echo -e "${YELLOW}You can view it with: less INSTALL.md${NC}"
fi

# Final instructions
echo ""
echo -e "${GREEN}=== Repository Clone Complete ===${NC}"
echo -e "${BLUE}The Geekquiz repository has been cloned to: ${YELLOW}$(pwd)${NC}"
echo -e "${BLUE}Please review the project files and any provided documentation for further setup instructions.${NC}"
echo -e "${BLUE}You may need to configure environment variables or database connections before running the application.${NC}"
echo ""
echo -e "${YELLOW}For more information, refer to the README.md file in the repository or visit:${NC}"
echo -e "${YELLOW}https://github.com/arcanoecole-It1/Geekquiz${NC}"

exit 0
