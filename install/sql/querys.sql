USE CabalEngine

SET ANSI_NULLS ON

SET QUOTED_IDENTIFIER ON

SET ANSI_PADDING ON

CREATE TABLE [dbo].[WEBENGINE_ACCOUNT_COUNTRY](
	[account] [varchar](10) NOT NULL,
	[country] [varchar](10) NOT NULL,
	[lastchange] [datetime] NULL,
 CONSTRAINT [PK_WEBENGINE_ACCOUNT_COUNTRY] PRIMARY KEY CLUSTERED 
(
	[account] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

SET ANSI_PADDING OFF

CREATE TABLE [dbo].[WEBENGINE_BANS](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[account_id] [varchar](50) NOT NULL,
	[banned_by] [varchar](50) NOT NULL,
	[ban_date] [int] NOT NULL,
	[ban_days] [int] NOT NULL,
	[ban_reason] [varchar](100) NULL
) ON [PRIMARY]CREATE TABLE [dbo].[WEBENGINE_BAN_LOG](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[account_id] [varchar](50) NOT NULL,
	[banned_by] [varchar](50) NOT NULL,
	[ban_type] [varchar](50) NOT NULL,
	[ban_date] [varchar](50) NOT NULL,
	[ban_days] [int] NULL,
	[ban_reason] [varchar](100) NULL
) ON [PRIMARY]CREATE TABLE [dbo].[WEBENGINE_BLOCKED_IP](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[block_ip] [varchar](50) NOT NULL,
	[block_by] [varchar](25) NOT NULL,
	[block_date] [varchar](50) NOT NULL,
 CONSTRAINT [PK_WEBENGINE_BLOCKED_IP] PRIMARY KEY CLUSTERED 
(
	[block_ip] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]CREATE TABLE [dbo].[WEBENGINE_CREDITS_CONFIG](
	[config_id] [int] IDENTITY(1,1) NOT NULL,
	[config_title] [varchar](50) NOT NULL,
	[config_database] [varchar](50) NOT NULL,
	[config_table] [varchar](50) NOT NULL,
	[config_credits_col] [varchar](50) NOT NULL,
	[config_user_col] [varchar](50) NOT NULL,
	[config_user_col_id] [varchar](50) NOT NULL,
	[config_checkonline] [tinyint] NOT NULL,
	[config_display] [tinyint] NOT NULL,
 CONSTRAINT [PK_WEBENGINE_CREDITS_CONFIG] PRIMARY KEY CLUSTERED 
(
	[config_id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]CREATE TABLE [dbo].[WEBENGINE_CREDITS_LOGS](
	[log_id] [int] IDENTITY(1,1) NOT NULL,
	[log_config] [varchar](50) NOT NULL,
	[log_identifier] [varchar](50) NOT NULL,
	[log_credits] [int] NOT NULL,
	[log_transaction] [varchar](50) NOT NULL,
	[log_date] [varchar](50) NOT NULL,
	[log_inadmincp] [tinyint] NULL,
	[log_module] [varchar](50) NULL,
	[log_ip] [varchar](50) NULL,
 CONSTRAINT [PK_WEBENGINE_CREDITS_LOGS] PRIMARY KEY CLUSTERED 
(
	[log_id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]CREATE TABLE [dbo].[WEBENGINE_CRON](
	[cron_id] [int] IDENTITY(1,1) NOT NULL,
	[cron_name] [varchar](100) NOT NULL,
	[cron_description] [varchar](max) NULL,
	[cron_file_run] [varchar](100) NOT NULL,
	[cron_run_time] [varchar](50) NOT NULL,
	[cron_last_run] [varchar](50) NULL,
	[cron_status] [int] NOT NULL,
	[cron_protected] [int] NOT NULL,
	[cron_file_md5] [varchar](50) NOT NULL
) ON [PRIMARY]CREATE TABLE [dbo].[WEBENGINE_DOWNLOADS](
	[download_id] [int] IDENTITY(1,1) NOT NULL,
	[download_title] [varchar](100) NOT NULL,
	[download_description] [varchar](100) NULL,
	[download_link] [varchar](max) NOT NULL,
	[download_size] [float] NULL,
	[download_type] [int] NOT NULL
) ON [PRIMARY]CREATE TABLE [dbo].[WEBENGINE_FLA](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[username] [varchar](50) NOT NULL,
	[ip_address] [varchar](50) NOT NULL,
	[unlock_timestamp] [varchar](50) NOT NULL,
	[failed_attempts] [int] NOT NULL,
	[timestamp] [varchar](50) NOT NULL
) ON [PRIMARY]CREATE TABLE [dbo].[WEBENGINE_NEWS](
	[news_id] [int] IDENTITY(1,1) NOT NULL,
	[news_title] [varchar](max) NOT NULL,
	[news_author] [varchar](50) NOT NULL,
	[news_date] [varchar](50) NOT NULL,
	[news_content] [text] NOT NULL,
	[allow_comments] [int] NOT NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]CREATE TABLE [dbo].[WEBENGINE_NEWS_TRANSLATIONS](
	[news_id] [int] NOT NULL,
	[news_language] [varchar](10) NOT NULL,
	[news_title] [varchar](max) NOT NULL,
	[news_content] [text] NOT NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]CREATE TABLE [dbo].[WEBENGINE_PASSCHANGE_REQUEST](
	[user_id] [int] NOT NULL,
	[new_password] [varchar](200) NOT NULL,
	[auth_code] [varchar](50) NOT NULL,
	[request_date] [varchar](50) NOT NULL,
 CONSTRAINT [PK_WEBENGINE_PASSCHANGE_REQUEST] PRIMARY KEY CLUSTERED 
(
	[user_id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]CREATE TABLE [dbo].[WEBENGINE_PAYPAL_TRANSACTIONS](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[transaction_id] [varchar](50) NOT NULL,
	[user_id] [int] NOT NULL,
	[payment_amount] [varchar](50) NOT NULL,
	[paypal_email] [varchar](200) NOT NULL,
	[transaction_date] [varchar](50) NOT NULL,
	[transaction_status] [int] NOT NULL,
	[order_id] [varchar](50) NOT NULL,
 CONSTRAINT [PK_WEBENGINE_PAYPAL_TRANSACTIONS] PRIMARY KEY CLUSTERED 
(
	[transaction_id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]CREATE TABLE [dbo].[WEBENGINE_PLUGINS](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[name] [varchar](100) NOT NULL,
	[author] [varchar](50) NOT NULL,
	[version] [varchar](50) NOT NULL,
	[compatibility] [varchar](max) NOT NULL,
	[folder] [varchar](max) NOT NULL,
	[files] [varchar](max) NOT NULL,
	[status] [int] NOT NULL,
	[install_date] [varchar](50) NOT NULL,
	[installed_by] [varchar](50) NOT NULL
) ON [PRIMARY]CREATE TABLE [dbo].[WEBENGINE_REGISTER_ACCOUNT](
	[registration_account] [varchar](50) NOT NULL,
	[registration_password] [varchar](50) NOT NULL,
	[registration_email] [varchar](50) NOT NULL,
	[registration_date] [varchar](50) NOT NULL,
	[registration_ip] [varchar](50) NOT NULL,
	[registration_key] [varchar](50) NOT NULL,
 CONSTRAINT [PK_WEBENGINE_REGISTER_ACCOUNT] PRIMARY KEY CLUSTERED 
(
	[registration_account] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]CREATE TABLE [dbo].[WEBENGINE_VOTES](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[user_id] [int] NOT NULL,
	[user_ip] [varchar](50) NOT NULL,
	[vote_site_id] [int] NOT NULL,
	[timestamp] [varchar](50) NOT NULL
) ON [PRIMARY]CREATE TABLE [dbo].[WEBENGINE_VOTE_LOGS](
	[user_id] [int] NOT NULL,
	[votesite_id] [int] NOT NULL,
	[timestamp] [varchar](50) NOT NULL
) ON [PRIMARY]CREATE TABLE [dbo].[WEBENGINE_VOTE_SITES](
	[votesite_id] [int] IDENTITY(1,1) NOT NULL,
	[votesite_title] [varchar](50) NOT NULL,
	[votesite_link] [varchar](max) NOT NULL,
	[votesite_reward] [int] NOT NULL,
	[votesite_time] [int] NOT NULL,
 CONSTRAINT [PK_WEBENGINE_VOTE_SITES] PRIMARY KEY CLUSTERED 
(
	[votesite_id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]