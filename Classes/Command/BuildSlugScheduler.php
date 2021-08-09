<?php
declare(strict_types = 1);
namespace Quizpalme\Camaliga\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class BuildSlugScheduler extends Command
{
    /**
     * Configure the command by defining the name, options and arguments
     */
    protected function configure()
    {
        $this
            ->setDescription('Create slugs for camaliga elements')
            ->setHelp('Create slugs for camaliga elements without a slug')
            //->setAliases(['ig:update'])
            ->addArgument(
                'pid',
                InputArgument::OPTIONAL,
                'the pid to use for rebuild',
                0
            );
    }
    /**
     * Executes the command for creating slugs
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int error code
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        //$io->writeln('Initiated and Processing...');
        $pid = intval($input->getArgument('pid'));
        $uids = [];
        $slugArray = [];
        $count = 0;

        $fieldConfig = $GLOBALS['TCA']['tx_camaliga_domain_model_content']['columns']['slug']['config'];
        $slugHelper = GeneralUtility::makeInstance(\TYPO3\CMS\Core\DataHandling\SlugHelper::class, 'tx_camaliga_domain_model_content', 'slug', $fieldConfig);

        // Alle Camaliga-Elemente holen
        $connection = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Database\ConnectionPool::class)->getConnectionForTable('tx_camaliga_domain_model_content');
        $queryBuilder = $connection->createQueryBuilder();
        if ($pid) {
            $statement = $queryBuilder->select('*')->from('tx_camaliga_domain_model_content')->where(
                $queryBuilder->expr()->eq('pid', $pid)
            )->execute();
        } else {
            $statement = $queryBuilder->select('*')->from('tx_camaliga_domain_model_content')->execute();
        }
        while ($row = $statement->fetch()) {
            $uids[] = $row['uid'];
        }

        // Alle Camaliga-Elemente durchgehen
        foreach ($uids as $uid) {
            $queryBuilder = $connection->createQueryBuilder();
            $queryBuilder->getRestrictions()->removeAll()->add(GeneralUtility::makeInstance(\TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction::class));
            $statement = $queryBuilder->select('*')->from('tx_camaliga_domain_model_content')->where(
                $queryBuilder->expr()->eq('uid', $uid)
            )->execute();

            $record = $statement->fetch();
            $slug = $record['slug'];

            if (!$slug) {
                $slug = $slugHelper->generate($record, $record['pid']);
                if ($slug) {
                    if ($slugArray[$slug]) {
                        // Der Slughelper prüft nicht auf unique, also müssen wir das machen
                        for ($i = 1; $i < 99; $i++) {
                            $tmp = $slug . '-' . $i;
                            if (!$slugArray[$tmp]) {
                                $slug = $tmp;
                                break;
                            }
                        }
                    }
                    $slugArray[$slug] = 1;
                    //echo "neuer Slug: $slug";
                    // Update
                    $queryBuilder = $connection->createQueryBuilder();
                    $queryBuilder->update('tx_camaliga_domain_model_content')->where(
                        $queryBuilder->expr()->eq('uid', $uid)
                    )->set('slug', $slug)->execute();
                    $count++;
                }
            } else {
                $slugArray[$slug] = 1;
            }
        }
        $io->success('Successfully updated slug for '.$count.' camaliga entries.');
        return 0;
    }
}