<?xml version="1.0" ?>

<xsl:stylesheet
    version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" />
    <xsl:template match="/">
        <html>
        <head>
            <title><xsl:value-of select="/root/content/title" /></title>
        </head>
        <body>
            <xsl:apply-templates />
        </body>
        </html>
    </xsl:template>
    <xsl:template match="content">
        <xsl:copy-of select="body" />
    </xsl:template>

    <!-- ignore options -->
    <xsl:template match="options" />
    <!-- ignore text() -->
    <xsl:template match="text()" />
</xsl:stylesheet>
